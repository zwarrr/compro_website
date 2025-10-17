<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Faq::query();

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('pertanyaan', 'like', "%{$search}%")
                  ->orWhere('jawaban', 'like', "%{$search}%")
                  ->orWhere('kode_faq', 'like', "%{$search}%");
            });
        }

        $faqs = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.faq.index', compact('faqs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
            'status' => 'required|in:publik,draft',
        ], [
            'pertanyaan.required' => 'Pertanyaan harus diisi',
            'pertanyaan.max' => 'Pertanyaan maksimal 255 karakter',
            'jawaban.required' => 'Jawaban harus diisi',
            'status.required' => 'Status harus dipilih',
            'status.in' => 'Status tidak valid',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $faq = Faq::create([
                'kode_faq' => 'FAQ-' . strtoupper(Str::random(8)),
                'pertanyaan' => $request->pertanyaan,
                'jawaban' => $request->jawaban,
                'status' => $request->status,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'FAQ berhasil ditambahkan',
                'data' => $faq
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan FAQ: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $faq = Faq::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => [
                    'id_faq' => $faq->id_faq,
                    'kode_faq' => $faq->kode_faq,
                    'pertanyaan' => $faq->pertanyaan,
                    'jawaban' => $faq->jawaban,
                    'status' => $faq->status,
                    'created_at' => $faq->created_at->format('d M Y H:i'),
                    'updated_at' => $faq->updated_at->format('d M Y H:i'),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'FAQ tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $faq = Faq::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $faq
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'FAQ tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
            'status' => 'required|in:publik,draft',
        ], [
            'pertanyaan.required' => 'Pertanyaan harus diisi',
            'pertanyaan.max' => 'Pertanyaan maksimal 255 karakter',
            'jawaban.required' => 'Jawaban harus diisi',
            'status.required' => 'Status harus dipilih',
            'status.in' => 'Status tidak valid',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $faq = Faq::findOrFail($id);

            $faq->update([
                'pertanyaan' => $request->pertanyaan,
                'jawaban' => $request->jawaban,
                'status' => $request->status,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'FAQ berhasil diperbarui',
                'data' => $faq
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui FAQ: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $faq = Faq::findOrFail($id);
            $faq->delete();

            return response()->json([
                'success' => true,
                'message' => 'FAQ berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus FAQ: ' . $e->getMessage()
            ], 500);
        }
    }
}
