<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Display the user profile page
     */
    public function index()
    {
        $user = Auth::user();
        return view('vlte3.profile.index', compact('user'));
    }

    /**
     * Show the user profile (for AJAX/JSON)
     */
    public function show()
    {
        $user = Auth::user();
        return response()->json([
            'success' => true,
            'user' => $user
        ]);
    }

    /**
     * Update the user profile
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id_user . ',id_user'],
            'foto_profile' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'current_password' => ['nullable', 'required_with:new_password'],
            'new_password' => ['nullable', 'confirmed', Password::defaults()],
        ], [
            'nama.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'foto_profile.image' => 'File harus berupa gambar',
            'foto_profile.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau svg',
            'foto_profile.max' => 'Ukuran gambar maksimal 2MB',
            'current_password.required_with' => 'Password lama harus diisi jika ingin mengubah password',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok',
        ]);

        // Update nama and email
        $user->nama = $validated['nama'];
        $user->email = $validated['email'];

        // Handle foto profile upload
        if ($request->hasFile('foto_profile')) {
            // Delete old photo if exists
            if ($user->foto_profile) {
                $oldPhotoPath = storage_path('app/public/' . $user->foto_profile);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            // Upload new photo
            $file = $request->file('foto_profile');
            $fileName = time() . '_' . $user->id_user . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/profile', $fileName);
            $user->foto_profile = str_replace('public/', '', $path);
        }

        // Update password if provided
        if ($request->filled('new_password')) {
            // Verify current password
            if (!Hash::check($request->current_password, $user->password)) {
                if ($request->wantsJson() || $request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'errors' => ['current_password' => ['Password lama tidak sesuai']]
                    ], 422);
                }
                return back()->withErrors(['current_password' => 'Password lama tidak sesuai']);
            }

            $user->password = Hash::make($validated['new_password']);
        }

        $user->save();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Profile berhasil diupdate!',
                'foto_url' => $user->foto_profile ? asset('storage/' . $user->foto_profile) : null
            ]);
        }

        return redirect()->route('admin.profile.index')->with('success', 'Profile berhasil diupdate!');
    }
}
