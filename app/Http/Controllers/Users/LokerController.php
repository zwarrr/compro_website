<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loker;
use App\Models\Lamaran;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LokerController extends Controller
{
    public function index()
    {
        // Ambil semua loker dengan status aktif
        $lokers = Loker::where('status', 'aktif')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('sections.loker', compact('lokers'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'loker_id' => 'required|exists:lokers,id_loker',
            'namaLengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:5120', // max 5MB
            'deskripsi' => 'required|string|min:100',
        ], [
            'loker_id.required' => 'Loker tidak valid',
            'loker_id.exists' => 'Loker tidak ditemukan',
            'namaLengkap.required' => 'Nama lengkap harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'resume.required' => 'Resume harus diupload',
            'resume.file' => 'Resume harus berupa file',
            'resume.mimes' => 'Resume harus berformat PDF, DOC, atau DOCX',
            'resume.max' => 'Ukuran resume maksimal 5MB',
            'deskripsi.required' => 'Deskripsi harus diisi',
            'deskripsi.min' => 'Deskripsi minimal 100 karakter',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Generate kode lamaran
            $last = Lamaran::orderBy('id_lamaran', 'desc')->first();
            if (!$last) {
                $kode = 'LAM-001';
            } else {
                $lastNumber = intval(substr($last->kode_lamaran, 4));
                $newNumber = $lastNumber + 1;
                $kode = 'LAM-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
            }

            // Upload file resume
            $resumePath = null;
            if ($request->hasFile('resume')) {
                $file = $request->file('resume');
                $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $resumePath = $file->storeAs('resume', $filename, 'public');
            }

            // Simpan data lamaran
            Lamaran::create([
                'kode_lamaran' => $kode,
                'loker_id' => $request->loker_id,
                'nama_lengkap' => $request->namaLengkap,
                'email' => $request->email,
                'resume' => $resumePath,
                'pesan' => $request->deskripsi,
                'status' => 'Diajukan',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Lamaran berhasil dikirim!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
