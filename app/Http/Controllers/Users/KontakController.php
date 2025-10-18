<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class KontakController extends Controller
{
    /**
     * Store a newly created contact message
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'subject.required' => 'Subjek harus diisi',
            'message.required' => 'Pesan harus diisi',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $kontak = Kontak::create([
                'kode_kontak' => 'KNT-' . strtoupper(Str::random(8)),
                'nama' => $request->name,
                'email' => $request->email,
                'subjek' => $request->subject,
                'pesan' => $request->message,
                'status_baca' => 'belum',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pesan berhasil dikirim! Kami akan menghubungi Anda segera.',
                'data' => $kontak
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim pesan: ' . $e->getMessage()
            ], 500);
        }
    }
}
