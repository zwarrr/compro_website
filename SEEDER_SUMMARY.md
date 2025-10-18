# Ringkasan Seeder Database

Semua seeder telah dibuat dengan minimal 15 data untuk setiap tabel. Berikut adalah detail seeder yang telah dibuat:

## 1. KategoriSeeder (20 data)
**File:** `database/seeders/KategoriSeeder.php`

Kategori dibagi menjadi 4 tipe dengan urutan yang terorganisir:

### Kategori Layanan (ID 1-5)
- LAY-001: Web Development
- LAY-002: Mobile Development
- LAY-003: UI/UX Design
- LAY-004: Digital Marketing
- LAY-005: Cloud Services

### Kategori Galeri (ID 6-10)
- GAL-001: Website Projects
- GAL-002: Mobile Apps
- GAL-003: Design Works
- GAL-004: Corporate Events
- GAL-005: Team Activities

### Kategori Karyawan (ID 11-15)
- KAR-001: Management
- KAR-002: Developer
- KAR-003: Designer
- KAR-004: Marketing
- KAR-005: Support

### Kategori Client (ID 16-20)
- CLI-001: Government
- CLI-002: Corporate
- CLI-003: Startup
- CLI-004: E-Commerce
- CLI-005: Education

---

## 2. UserSeeder (15 data)
**File:** `database/seeders/UserSeeder.php`

15 user dengan email dan password:
- Admin Utama (admin@compro.com) - password: admin123
- 14 user lainnya dengan password: password123

---

## 3. FaqSeeder (15 data)
**File:** `database/seeders/FaqSeeder.php`

15 FAQ dengan pertanyaan dan jawaban seputar:
- Layanan perusahaan
- Waktu pengerjaan
- Garansi
- Support
- Pembayaran
- Maintenance
- Dan lainnya

Semua FAQ berstatus **publik**.

---

## 4. TestimoniSeeder (15 data)
**File:** `database/seeders/TestimoniSeeder.php`

15 testimoni dari berbagai klien dengan:
- Nama dan jabatan
- Pesan testimoni
- Rating (4-5 bintang)
- Status: publik

---

## 5. ClientSeeder (15 data)
**File:** `database/seeders/ClientSeeder.php`

15 klien dari berbagai kategori:
- Government (Kementerian, Pemprov, BPS)
- Corporate (BCA, Telkom, Unilever, Astra)
- Startup (Gojek, Ruangguru, Traveloka)
- E-Commerce (Tokopedia, Shopee, Bukalapak)
- Education (Universitas Indonesia, ITB)

Setiap client memiliki website dan deskripsi proyek.

---

## 6. GaleriSeeder (15 data)
**File:** `database/seeders/GaleriSeeder.php`

15 item galeri terdiri dari:
- 4 Website Projects
- 4 Mobile Apps
- 3 Design Works
- 2 Corporate Events
- 2 Team Activities

Semua galeri berstatus **aktif**.

---

## 7. KaryawanSeeder (15 data)
**File:** `database/seeders/KaryawanSeeder.php`

15 karyawan dengan distribusi:
- 3 Management (CEO, CTO, CFO)
- 4 Developer (Full Stack, Mobile, Backend, Frontend)
- 3 Designer (UI/UX Lead, Graphic, Motion)
- 3 Marketing (Manager, Content Specialist, Social Media)
- 2 Support (Customer Support Lead, Technical Support)

Setiap karyawan memiliki NIK unik dan deskripsi lengkap.

---

## 8. LayananSeeder (15 data)
**File:** `database/seeders/LayananSeeder.php`

15 layanan terdiri dari:
- 3 Web Development (Custom Website, E-Commerce, CMS)
- 3 Mobile Development (iOS, Android, Cross-Platform)
- 3 UI/UX Design (UI/UX Services, Branding, Prototype)
- 3 Digital Marketing (SEO, Social Media, Content Marketing)
- 3 Cloud Services (Cloud Migration, DevOps, Infrastructure Management)

Setiap layanan memiliki judul, slogan, link, dan deskripsi lengkap.

---

## 9. SocialMediaSeeder (15 data)
**File:** `database/seeders/SocialMediaSeeder.php`

15 platform social media:
- Facebook, Instagram, Twitter, LinkedIn
- YouTube, TikTok, WhatsApp Business, Telegram
- GitHub, Dribbble, Behance, Medium
- Discord, Pinterest, Slack

Setiap social media memiliki icon Font Awesome dan warna brand.

---

## 10. ProfilePerusahaanSeeder (1 data)
**File:** `database/seeders/ProfilePerusahaanSeeder.php`

1 profile perusahaan lengkap dengan:
- Nama: PT Compro Digital Indonesia
- Slogan, deskripsi, visi, misi
- Alamat, telepon, email
- Kode profile: PROF-001

---

## 11. KontakSeeder (15 data)
**File:** `database/seeders/KontakSeeder.php`

15 pesan kontak dari berbagai klien dengan:
- Nama, email, subjek, pesan
- Status baca: belum/sudah
- Created_at: tersebar 15 hari terakhir

---

## Cara Menjalankan Seeder

### Menjalankan Semua Seeder
```bash
php artisan db:seed
```

### Menjalankan Seeder Spesifik
```bash
php artisan db:seed --class=KategoriSeeder
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=FaqSeeder
# dst...
```

### Refresh Database dan Seed
```bash
php artisan migrate:fresh --seed
```

---

## Urutan Seeder di DatabaseSeeder

Seeder dijalankan dengan urutan berikut (penting karena foreign key dependencies):

1. UserSeeder
2. ProfilePerusahaanSeeder
3. **KategoriSeeder** (Harus pertama karena dipakai tabel lain)
4. LayananSeeder (depends on Kategori)
5. GaleriSeeder (depends on Kategori)
6. KaryawanSeeder (depends on Kategori)
7. ClientSeeder (depends on Kategori)
8. TestimoniSeeder (independent)
9. FaqSeeder (independent)
10. SocialMediaSeeder (independent)
11. KontakSeeder (independent)

---

## Catatan Penting

✅ Semua seeder memiliki minimal 15 data
✅ Kategori telah diurutkan dengan baik (LAY, GAL, KAR, CLI)
✅ Semua field wajib telah diisi
✅ Foreign key sudah disesuaikan dengan ID kategori yang benar
✅ Status field disesuaikan dengan enum di migration
✅ Data realistis dan relevan dengan bisnis IT/Digital

---

Dibuat pada: 18 Oktober 2025
