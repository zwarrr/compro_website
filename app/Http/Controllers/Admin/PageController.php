<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Page;
use App\Models\Ilustrasi;
use Illuminate\Validation\ValidationException;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Page::with('ilustrasi');

        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('kode_page', 'like', "%{$search}%")
                    ->orWhere('sub_judul', 'like', "%{$search}%");
            });
        }

        // Filter by ilustrasi
        if ($request->has('ilustrasi_id') && $request->ilustrasi_id != '') {
            $query->where('ilustrasi_id', $request->ilustrasi_id);
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Sorting
        $allowedSorts = ['created_at', 'judul', 'kode_page'];
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'created_at';
        }
        if (!in_array(strtolower($direction), ['asc', 'desc'])) {
            $direction = 'desc';
        }
        $query->orderBy($sort, $direction);

        $pages = $query->paginate(10)->appends($request->except('page'));
        $ilustrasis = Ilustrasi::all();
        return view('vlte3.page.index', compact('pages', 'ilustrasis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ilustrasis = Ilustrasi::all();
        return view('vlte3.page.create', compact('ilustrasis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validation
        $validated = $request->validate([
            'ilustrasi_id' => 'nullable|exists:ilustrasis,id_ilustrasi',
            'digunakan_untuk' => 'required|unique:pages,digunakan_untuk', // Unique check is important here
            'judul' => 'required',
            'sub_judul' => 'nullable',
            'deskripsi' => 'nullable',
            'button_primary_text' => 'nullable',
            'button_primary_link' => 'nullable',
            'button_secondary_text' => 'nullable',
            'button_secondary_link' => 'nullable',
            'status' => 'required|in:public,draft',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $data = $request->only([
            'ilustrasi_id', 'digunakan_untuk', 'judul', 'sub_judul', 'deskripsi',
            'button_primary_text', 'button_primary_link', 'button_secondary_text', 'button_secondary_link', 'status'
        ]);

        try {
            // 2. Image Upload
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('page', 'public');
            }

            // 3. Generate kode_page otomatis (PAGE001, PAGE002, dst)
            $lastPage = Page::orderBy('id_page', 'desc')->first();
            $nextNumber = 1;
            if ($lastPage && preg_match('/^PAGE(\d{3})$/', $lastPage->kode_page, $matches)) {
                $nextNumber = intval($matches[1]) + 1;
            }
            $data['kode_page'] = 'PAGE' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

            // 4. Create record
            $page = Page::create($data);

            // 5. Response
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Page berhasil ditambahkan',
                    'page' => $page
                ], 201);
            }
            return redirect()->route('admin.page.index')->with('success', 'Page berhasil ditambahkan');

        } catch (ValidationException $e) {
             // Validation exceptions are usually caught by Laravel's Handler, but we include this for AJAX/JSON consistency
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            // Handle general server errors
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan pada server: ' . $e->getMessage(),
                ], 500);
            }
            return redirect()->back()->withInput()->withErrors(['server_error' => 'Terjadi kesalahan saat menyimpan data.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $page = Page::with('ilustrasi')->findOrFail($id);

        if (request()->ajax() || request()->wantsJson()) {
            // Add formatted dates
            $page->created_at_formatted = $page->created_at ? $page->created_at->format('d M Y H:i') : null;
            $page->updated_at_formatted = $page->updated_at ? $page->updated_at->format('d M Y H:i') : null;
            
            // Add image URL if illustration exists
            if ($page->ilustrasi && $page->ilustrasi->image) {
                $page->ilustrasi->image_url = asset('storage/' . $page->ilustrasi->image);
            }

            return response()->json(['success' => true, 'page' => $page]);
        }
        return view('vlte3.page.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $page = Page::findOrFail($id);
        $ilustrasis = Ilustrasi::all();

        if (request()->ajax() || request()->wantsJson()) {
            // Add image URL if illustration exists
            if ($page->ilustrasi && $page->ilustrasi->image) {
                $page->ilustrasi->image_url = asset('storage/' . $page->ilustrasi->image);
            }
            return response()->json(['success' => true, 'page' => $page, 'ilustrasis' => $ilustrasis]);
        }
        return view('vlte3.page.edit', compact('page', 'ilustrasis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        // 1. Validation (Unique rule includes current ID for exclusion)
        $validated = $request->validate([
            'ilustrasi_id' => 'nullable|exists:ilustrasis,id_ilustrasi',
            'digunakan_untuk' => 'required|unique:pages,digunakan_untuk,' . $page->id_page . ',id_page',
            'judul' => 'required',
            'sub_judul' => 'nullable',
            'deskripsi' => 'nullable',
            'button_primary_text' => 'nullable',
            'button_primary_link' => 'nullable',
            'button_secondary_text' => 'nullable',
            'button_secondary_link' => 'nullable',
            'status' => 'required|in:public,draft',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $data = $request->only([
            'ilustrasi_id', 'digunakan_untuk', 'judul', 'sub_judul', 'deskripsi',
            'button_primary_text', 'button_primary_link', 'button_secondary_text', 'button_secondary_link', 'status'
        ]);

        try {
            // 2. Image Update Logic
            if ($request->hasFile('image')) {
                // Delete old image if it exists
                if ($page->image) {
                    Storage::disk('public')->delete($page->image);
                }
                // Store new image
                $data['image'] = $request->file('image')->store('page', 'public');
            } elseif ($request->input('remove_image')) {
                // Handle case where user explicitly removes the image (if needed, based on form structure)
                if ($page->image) {
                    Storage::disk('public')->delete($page->image);
                }
                $data['image'] = null;
            } else {
                // Keep the existing image path if no new file is uploaded
                $data['image'] = $page->image;
            }
            
            // 3. Update record
            $page->update($data);

            // 4. Response
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Page berhasil diupdate',
                    'page' => $page
                ]);
            }
            return redirect()->route('admin.page.index')->with('success', 'Page berhasil diupdate');

        } catch (ValidationException $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan pada server: ' . $e->getMessage(),
                ], 500);
            }
            return redirect()->back()->withInput()->withErrors(['server_error' => 'Terjadi kesalahan saat mengupdate data.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $page = Page::findOrFail($id);

        try {
            // 1. Delete associated image file first
            if ($page->image) {
                Storage::disk('public')->delete($page->image);
            }
            
            // 2. Delete record
            $page->delete();

            // 3. Response
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Page berhasil dihapus'
                ]);
            }
            return redirect()->route('admin.page.index')->with('success', 'Page berhasil dihapus');
        } catch (\Exception $e) {
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan pada server: ' . $e->getMessage()
                ], 500);
            }
            throw $e;
        }
    }
}
