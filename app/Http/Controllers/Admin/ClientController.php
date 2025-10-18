<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Generate kode client otomatis
     */
    private function generateKode()
    {
        $lastClient = Client::orderBy('id_client', 'desc')->first();
        
        if (!$lastClient) {
            return 'CLT-001';
        }
        
        $lastNumber = intval(substr($lastClient->kode_client, 4));
        $newNumber = $lastNumber + 1;
        
        return 'CLT-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Client::with('kategori');

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_client', 'like', "%{$search}%")
                  ->orWhere('kode_client', 'like', "%{$search}%")
                  ->orWhere('website', 'like', "%{$search}%");
            });
        }

        // Filter by kategori
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori_id', $request->kategori);
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Pagination
        $clients = $query->latest()->paginate(10);
        $kategoris = Kategori::where('tipe', 'client')->get();

        return view('admin.client.index', compact('clients', 'kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required|exists:kategori,id_kategori',
            'nama_client' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'website' => 'nullable|url|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:publik,draft',
        ], [
            'kategori_id.required' => 'Kategori harus diisi',
            'kategori_id.exists' => 'Kategori tidak valid',
            'nama_client.required' => 'Nama client harus diisi',
            'logo.image' => 'File harus berupa gambar',
            'logo.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'logo.max' => 'Ukuran gambar maksimal 10MB',
            'website.url' => 'Format website tidak valid',
            'status.required' => 'Status harus diisi',
            'status.in' => 'Status tidak valid',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = [
                'kode_client' => $this->generateKode(),
                'kategori_id' => $request->kategori_id,
                'nama_client' => $request->nama_client,
                'website' => $request->website,
                'deskripsi' => $request->deskripsi,
                'status' => $request->status,
            ];

            // Handle logo upload
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $logoName = $request->nama_client . '.' . $logo->getClientOriginalExtension();
                $logo->storeAs('public/clients', $logoName);
                $data['logo'] = 'clients/' . $logoName;
            }

            Client::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Client berhasil ditambahkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $client = Client::with('kategori')->findOrFail($id);
            
            $clientData = [
                'id_client' => $client->id_client,
                'kode_client' => $client->kode_client,
                'kategori_id' => $client->kategori_id,
                'kategori_nama' => $client->kategori ? $client->kategori->nama_kategori : '-',
                'nama_client' => $client->nama_client,
                'logo' => $client->logo ? asset('storage/' . $client->logo) : null,
                'website' => $client->website ?? '-',
                'deskripsi' => $client->deskripsi ?? '-',
                'status' => $client->status,
                'created_at_formatted' => $client->created_at ? $client->created_at->format('d M Y H:i') : '-',
                'updated_at_formatted' => $client->updated_at ? $client->updated_at->format('d M Y H:i') : '-',
            ];
            
            return response()->json([
                'success' => true,
                'data' => $clientData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Client tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $client = Client::with('kategori')->findOrFail($id);
            
            $clientData = [
                'id_client' => $client->id_client,
                'kode_client' => $client->kode_client,
                'kategori_id' => $client->kategori_id,
                'nama_client' => $client->nama_client,
                'logo' => $client->logo ? asset('storage/' . $client->logo) : null,
                'logo_path' => $client->logo,
                'website' => $client->website,
                'deskripsi' => $client->deskripsi,
                'status' => $client->status,
            ];
            
            return response()->json([
                'success' => true,
                'data' => $clientData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Client tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required|exists:kategori,id_kategori',
            'nama_client' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'website' => 'nullable|url|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:publik,draft',
        ], [
            'kategori_id.required' => 'Kategori harus diisi',
            'kategori_id.exists' => 'Kategori tidak valid',
            'nama_client.required' => 'Nama client harus diisi',
            'logo.image' => 'File harus berupa gambar',
            'logo.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'logo.max' => 'Ukuran gambar maksimal 10MB',
            'website.url' => 'Format website tidak valid',
            'status.required' => 'Status harus diisi',
            'status.in' => 'Status tidak valid',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = [
                'kategori_id' => $request->kategori_id,
                'nama_client' => $request->nama_client,
                'website' => $request->website,
                'deskripsi' => $request->deskripsi,
                'status' => $request->status,
            ];

            // Handle logo upload
            if ($request->hasFile('logo')) {
                // Delete old logo
                if ($client->logo && Storage::exists('public/' . $client->logo)) {
                    Storage::delete('public/' . $client->logo);
                }

                $logo = $request->file('logo');
                $logoName = $request->nama_client . '_' . $logo->getClientOriginalExtension();
                $logo->storeAs('public/clients', $logoName);
                $data['logo'] = 'clients/' . $logoName;
            }

            $client->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Client berhasil diperbarui!'
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
            $client = Client::findOrFail($id);
            
            // Delete logo
            if ($client->logo && Storage::exists('public/' . $client->logo)) {
                Storage::delete('public/' . $client->logo);
            }
            
            $client->delete();

            return response()->json([
                'success' => true,
                'message' => 'Client berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
