<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lamaran;
use App\Models\Loker;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\LamaranReply;
use Illuminate\Support\Facades\Log;

class LamaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Lamaran::with('loker');

        if ($request->has('search') && $request->search != '') {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('nama_lengkap', 'like', "%{$s}%")
                    ->orWhere('email', 'like', "%{$s}%")
                    ->orWhere('kode_lamaran', 'like', "%{$s}%")
                    ->orWhere('pesan', 'like', "%{$s}%");
            });
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('loker_id') && $request->loker_id != '') {
            $query->where('loker_id', $request->loker_id);
        }

        // handle sorting
        $allowedSorts = ['created_at', 'nama_lengkap', 'kode_lamaran', 'status'];
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');
        if (!in_array($sort, $allowedSorts)) $sort = 'created_at';
        if (!in_array(strtolower($direction), ['asc', 'desc'])) $direction = 'desc';

        $lamarans = $query->orderBy($sort, $direction)->paginate(15)->appends($request->except('page'));
        return view('vlte3.lamaran.index', compact('lamarans'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $lamaran = Lamaran::with('loker')->findOrFail($id);
            return response()->json([
                'success' => true,
                'lamaran' => $lamaran
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lamaran tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $lamaran = Lamaran::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:Diajukan,Diterima,Tolak,Ditolak,Dikirim',
            'catatan_hrd' => 'nullable|string',
            'tanggal_interview' => 'nullable|date',
        ]);

        // The allowed values intended: the user specified Diajukan, Diterima, Ditolak, Dikirim
        // Accept common typo 'Tolak' --> map later if needed

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = $request->only(['status', 'catatan_hrd', 'tanggal_interview']);
            // Normalize status typos
            if (isset($data['status']) && $data['status'] === 'Tolak') {
                $data['status'] = 'Ditolak';
            }
            $lamaran->update($data);
            return response()->json([
                'success' => true,
                'message' => 'Lamaran berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $lamaran = Lamaran::findOrFail($id);
            $lamaran->delete();
            return response()->json([
                'success' => true,
                'message' => 'Lamaran berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Reply to a lamaran: send email and update status to Dikirim
     */
    public function reply(Request $request, $id)
    {
        $lamaran = Lamaran::with('loker')->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'catatan_hrd' => 'required|string',
            'tanggal_interview' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $catatan = $request->catatan_hrd;
        $tanggal = $request->tanggal_interview ? date('d M Y H:i', strtotime($request->tanggal_interview)) : '-';

        try {
            // basic email validation
            if (empty($lamaran->email) || !filter_var($lamaran->email, FILTER_VALIDATE_EMAIL)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email pelamar tidak valid atau kosong'
                ], 422);
            }
            // Try to send email immediately. If that fails, fallback to queue.
            $mailable = new LamaranReply(
                $lamaran->nama_lengkap,
                $lamaran->loker ? $lamaran->loker->perusahaan : config('app.name'),
                $tanggal,
                $catatan
            );

            try {
                // attempt synchronous send
                Mail::to($lamaran->email)->send($mailable);
                Log::info('Lamaran reply sent synchronously to ' . $lamaran->email . ' for lamaran id ' . $lamaran->id);
            } catch (\Exception $mailEx) {
                // fallback to queueing the mailable if sync send fails
                Log::warning('Synchronous mail send failed, attempting to queue. Error: ' . $mailEx->getMessage());
                try {
                    Mail::to($lamaran->email)->queue($mailable);
                    Log::info('Lamaran reply queued for ' . $lamaran->email . ' for lamaran id ' . $lamaran->id);
                } catch (\Exception $queueEx) {
                    Log::error('Failed to queue lamaran reply: ' . $queueEx->getMessage());
                    return response()->json([
                        'success' => false,
                        'message' => 'Gagal mengirim email: ' . $queueEx->getMessage()
                    ], 500);
                }
            }

            // Update database
            $lamaran->update([
                'catatan_hrd' => $catatan,
                'tanggal_interview' => $request->tanggal_interview,
                'status' => 'Dikirim'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Balasan berhasil dikirim ke email pelamar'
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal mengirim balasan lamaran: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim email: ' . $e->getMessage()
            ], 500);
        }
    }
}
