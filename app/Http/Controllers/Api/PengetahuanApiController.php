<?php

namespace App\Http\Controllers\Api;

use App\Models\Pengetahuan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PengetahuanApiController extends Controller
{
    /**
     * Get all categories
     */
    public function getCategories()
    {
        $categories = Pengetahuan::distinct()
            ->pluck('kategori_pertanyaan')
            ->sort()
            ->values();

        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

    /**
     * Get sub categories by category
     */
    public function getSubCategories($kategori)
    {
        $subCategories = Pengetahuan::where('kategori_pertanyaan', $kategori)
            ->distinct()
            ->pluck('sub_kategori')
            ->sort()
            ->values();

        return response()->json([
            'success' => true,
            'data' => $subCategories
        ]);
    }

    /**
     * Get answer by category and sub category
     */
    public function getAnswer($kategori, $subKategori)
    {
        $pengetahuan = Pengetahuan::where('kategori_pertanyaan', $kategori)
            ->where('sub_kategori', $subKategori)
            ->first();

        if (!$pengetahuan) {
            return response()->json([
                'success' => false,
                'message' => 'Jawaban tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'kode' => $pengetahuan->kode_pengetahuan,
                'kategori' => $pengetahuan->kategori_pertanyaan,
                'sub_kategori' => $pengetahuan->sub_kategori,
                'jawaban' => $pengetahuan->jawaban
            ]
        ]);
    }

    /**
     * Search knowledge base
     */
    public function search(Request $request)
    {
        $query = $request->get('q', '');

        if (strlen($query) < 2) {
            return response()->json([
                'success' => false,
                'message' => 'Query minimal 2 karakter'
            ], 400);
        }

        $results = Pengetahuan::where('kategori_pertanyaan', 'LIKE', "%{$query}%")
            ->orWhere('sub_kategori', 'LIKE', "%{$query}%")
            ->orWhere('jawaban', 'LIKE', "%{$query}%")
            ->select('kategori_pertanyaan', 'sub_kategori', 'jawaban')
            ->distinct()
            ->get();

        return response()->json([
            'success' => true,
            'count' => $results->count(),
            'data' => $results
        ]);
    }
}
