# CRUD Implementation Guide

## ✅ Yang Sudah Dibuat

### 1. Controllers (100% Complete)
- ✅ `KategoriController.php` - dengan auto-generate kode `KAT-001`
- ✅ `LayananController.php` - dengan auto-generate kode `LAY-001` + upload gambar
- ✅ `GaleriController.php` - dengan auto-generate kode `GAL-001` + upload gambar
- ✅ `KaryawanController.php` - dengan auto-generate kode `KAR-001` + upload foto

### 2. Routes (100% Complete)
✅ Semua route resource sudah ditambahkan di `web.php`

### 3. Kategori Views (100% Complete)
- ✅ `kategori/index.blade.php`
- ✅ `kategori/modals/create.blade.php`
- ✅ `kategori/modals/detail.blade.php`
- ✅ `kategori/modals/edit.blade.php`
- ✅ `kategori/modals/delete.blade.php`
- ✅ `kategori/scripts.blade.php`

---

## 📋 Yang Perlu Dibuat

Untuk **Layanan**, **Galeri**, dan **Karyawan**, Anda perlu membuat file-file berikut dengan pola yang sama seperti Kategori:

### Struktur File untuk LAYANAN:
```
resources/views/admin/layanan/
├── index.blade.php
├── scripts.blade.php
└── modals/
    ├── create.blade.php
    ├── detail.blade.php
    ├── edit.blade.php
    └── delete.blade.php
```

### Struktur File untuk GALERI:
```
resources/views/admin/galeri/
├── index.blade.php
├── scripts.blade.php
└── modals/
    ├── create.blade.php
    ├── detail.blade.php
    ├── edit.blade.php
    └── delete.blade.php
```

### Struktur File untuk KARYAWAN:
```
resources/views/admin/karyawan/
├── index.blade.php
├── scripts.blade.php
└── modals/
    ├── create.blade.php
    ├── detail.blade.php
    ├── edit.blade.php
    └── delete.blade.php
```

---

## 🔄 Pola Penggantian (Find & Replace)

Untuk membuat file Layanan, Galeri, dan Karyawan, gunakan file Kategori sebagai template dan lakukan find & replace berikut:

### Untuk LAYANAN:
| Ganti dari | Ganti ke |
|------------|----------|
| `kategori` | `layanan` |
| `Kategori` | `Layanan` |
| `KATEGORI` | `LAYANAN` |
| `id_kategori` | `id_layanan` |
| `kode_kategori` | `kode_layanan` |
| `nama_kategori` | `judul` |
| `tipe` | `slog` |

**Field Tambahan untuk Layanan:**
- `kategori_id` (foreign key ke tabel kategori)
- `deskripsi`
- `gambar` (file upload)
- `status` (aktif/nonaktif)

### Untuk GALERI:
| Ganti dari | Ganti ke |
|------------|----------|
| `kategori` | `galeri` |
| `Kategori` | `Galeri` |
| `KATEGORI` | `GALERI` |
| `id_kategori` | `id_galeri` |
| `kode_kategori` | `kode_galeri` |
| `nama_kategori` | `judul` |

**Field Tambahan untuk Galeri:**
- `kategori_id` (foreign key ke tabel kategori)
- `deskripsi`
- `gambar` (file upload)
- `status` (aktif/nonaktif)

### Untuk KARYAWAN:
| Ganti dari | Ganti ke |
|------------|----------|
| `kategori` | `karyawan` |
| `Kategori` | `Karyawan` |
| `KATEGORI` | `KARYAWAN` |
| `id_kategori` | `id_karyawan` |
| `kode_kategori` | `kode_karyawan` |
| `nama_kategori` | `nama` |

**Field Tambahan untuk Karyawan:**
- `kategori_id` (foreign key ke tabel kategori)
- `nik` (unique)
- `deskripsi`
- `foto` (file upload)
- `status` (aktif/nonaktif)

---

## 🎨 Contoh Form Field untuk Modal Create

### Layanan (create.blade.php):
```html
<!-- Kategori -->
<div>
    <label for="create_kategori_id" class="block text-sm font-semibold text-gray-700 mb-1">Kategori</label>
    <select id="create_kategori_id" name="kategori_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary">
        <option value="">Pilih Kategori</option>
        @foreach($kategoris as $kat)
            <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
        @endforeach
    </select>
    <span class="text-red-500 text-xs mt-1 hidden" id="error_create_kategori_id"></span>
</div>

<!-- Judul -->
<div>
    <label for="create_judul" class="block text-sm font-semibold text-gray-700 mb-1">Judul</label>
    <input type="text" id="create_judul" name="judul" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary" placeholder="Masukkan judul layanan">
    <span class="text-red-500 text-xs mt-1 hidden" id="error_create_judul"></span>
</div>

<!-- Slog -->
<div>
    <label for="create_slog" class="block text-sm font-semibold text-gray-700 mb-1">Slog</label>
    <input type="text" id="create_slog" name="slog" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary" placeholder="Masukkan slog">
    <span class="text-red-500 text-xs mt-1 hidden" id="error_create_slog"></span>
</div>

<!-- Deskripsi -->
<div>
    <label for="create_deskripsi" class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
    <textarea id="create_deskripsi" name="deskripsi" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary" placeholder="Masukkan deskripsi"></textarea>
    <span class="text-red-500 text-xs mt-1 hidden" id="error_create_deskripsi"></span>
</div>

<!-- Gambar -->
<div>
    <label for="create_gambar" class="block text-sm font-semibold text-gray-700 mb-1">Gambar</label>
    <input type="file" id="create_gambar" name="gambar" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary">
    <span class="text-red-500 text-xs mt-1 hidden" id="error_create_gambar"></span>
</div>

<!-- Status -->
<div>
    <label for="create_status" class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
    <select id="create_status" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary">
        <option value="aktif">Aktif</option>
        <option value="nonaktif">Non-Aktif</option>
    </select>
    <span class="text-red-500 text-xs mt-1 hidden" id="error_create_status"></span>
</div>
```

---

## 📝 Tips Penting

1. **Upload File**: Untuk Layanan, Galeri, dan Karyawan yang memiliki upload file, ubah form menjadi `enctype="multipart/form-data"`:
   ```html
   <form id="createLayananForm" onsubmit="submitCreate(event)" class="p-8" enctype="multipart/form-data">
   ```

2. **FormData di Scripts**: Untuk form dengan file upload, pastikan menggunakan `FormData`:
   ```javascript
   const formData = new FormData(form);
   // Jangan set Content-Type header, biarkan browser yang mengatur
   ```

3. **Preview Gambar**: Untuk menampilkan preview gambar di detail modal:
   ```html
   <div id="detail_gambar_preview" class="hidden">
       <label class="block text-sm font-medium text-gray-500 mb-1">Gambar</label>
       <img id="detail_gambar_url" src="" alt="Gambar" class="w-full max-w-md rounded-lg">
   </div>
   ```

4. **Dropdown Kategori**: Pastikan di controller index, Anda juga mengirim data kategori:
   ```php
   $kategoris = Kategori::where('tipe', 'layanan')->get();
   return view('admin.layanan.index', compact('layanans', 'kategoris'));
   ```

---

## 🚀 Cara Menggunakan

1. **Copy** file kategori sebagai template
2. **Find & Replace** sesuai tabel di atas
3. **Sesuaikan** field-field form sesuai kebutuhan (tambahkan kategori_id, gambar, dll)
4. **Test** di browser

---

## 📁 Folder Upload Images

Jangan lupa buat folder untuk menyimpan gambar:
```
public/images/
├── layanan/
├── galeri/
└── karyawan/
```

Atau jalankan command:
```bash
mkdir public/images/layanan
mkdir public/images/galeri
mkdir public/images/karyawan
```

---

## ✨ Fitur yang Sudah Diimplementasi

- ✅ Auto-generate kode (KAT-001, LAY-001, dll)
- ✅ CRUD lengkap dengan modal
- ✅ Search & Filter
- ✅ Pagination
- ✅ Upload file/gambar
- ✅ Validasi form
- ✅ Notifikasi success/error
- ✅ Responsive design
- ✅ Loading state
- ✅ Color primary konsisten

---

Semoga panduan ini membantu! 🎉
