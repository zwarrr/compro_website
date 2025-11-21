# Chatbot Log Feature - Implementation Summary

## Overview
Fitur log chatbot untuk mencatat pertanyaan yang tidak ditemukan di knowledge base.

## Perubahan yang Dilakukan

### 1. Model Downgrade
- **File**: `config/openai.php`
- **Perubahan**: Downgrade dari `gpt-4-turbo` ke `gpt-3.5-turbo`
- Model lebih cepat dan efisien untuk chatbot customer service

### 2. Database Migration
- **File**: `database/migrations/2025_11_21_131159_create_chatbot_logs_table.php`
- **Tabel**: `chatbot_logs`
- **Fields**:
  - `id` - Primary key
  - `question` - Pertanyaan user (text)
  - `user_ip` - IP address user (varchar 45)
  - `session_id` - Session ID untuk tracking (varchar)
  - `is_resolved` - Status penanganan (boolean, default: false)
  - `admin_note` - Catatan admin (text, nullable)
  - `created_at` & `updated_at` - Timestamps

### 3. Model ChatbotLog
- **File**: `app/Models/ChatbotLog.php`
- **Fillable**: question, user_ip, session_id, is_resolved, admin_note
- **Casts**: is_resolved (boolean), timestamps (datetime)

### 4. OpenAI Service Enhancement
- **File**: `app/Services/OpenAIService.php`
- **Method Baru**: `checkIfInKnowledgeBase($message)`
  - Mengecek apakah pertanyaan ada di knowledge base
  - Menggunakan keyword matching dengan minimal 2 keyword match
  - Keywords diambil dari kategori, sub_kategori, dan jawaban
- **Method Update**: `chat()`
  - Tambahan parameter: `$userIp`, `$sessionId`
  - Auto-logging jika pertanyaan tidak ada di knowledge base
  - Menggunakan `ChatbotLog::create()` untuk menyimpan log

### 5. ChatbotController Update
- **File**: `app/Http/Controllers/ChatbotController.php`
- **Perubahan**: Mengirim IP address dan session ID ke OpenAIService
- Menggunakan `$request->ip()` dan `session()->getId()`

### 6. Admin Controller
- **File**: `app/Http/Controllers/Admin/ChatbotLogController.php`
- **Methods**:
  - `index()` - Menampilkan daftar log dengan filter dan search
  - `show($id)` - Menampilkan detail log (AJAX)
  - `update($id)` - Update status resolved dan admin note
  - `destroy($id)` - Hapus log

### 7. Admin Views
**Files Created**:
- `resources/views/vlte3/chatbot-log/index.blade.php` - Main view
- `resources/views/vlte3/chatbot-log/partials/filter.blade.php` - Filter form
- `resources/views/vlte3/chatbot-log/partials/table.blade.php` - Data table
- `resources/views/vlte3/chatbot-log/partials/modal-detail.blade.php` - Detail modal
- `resources/views/vlte3/chatbot-log/partials/modal-delete.blade.php` - Delete modal
- `resources/views/vlte3/chatbot-log/partials/scripts.blade.php` - JavaScript handlers

**Features**:
- Filter by status (Belum Ditangani / Sudah Ditangani)
- Search by question text
- Pagination (15 items per page)
- View detail with modal
- Mark as resolved
- Add admin notes
- Delete log

### 8. Routes
- **File**: `routes/web.php`
- **Routes Added**:
  ```php
  Route::resource('chatbot-log', ChatbotLogController::class)
      ->only(['index', 'show', 'update', 'destroy']);
  ```

### 9. Sidebar Menu
- **File**: `resources/views/components/vlte3/sidebar.blade.php`
- **Perubahan**: Mengganti menu "Blog" dengan "Log Chatbot"
- **Icon**: `fas fa-comments`
- **Route**: `admin.chatbot-log.index`

## Cara Kerja Sistem

1. **User Mengajukan Pertanyaan**
   - User bertanya di chatbot frontend
   - Pertanyaan dikirim ke `ChatbotController@sendMessage`

2. **Pengecekan Knowledge Base**
   - `OpenAIService` mengecek apakah pertanyaan ada di knowledge base
   - Menggunakan keyword matching (minimal 2 kata yang cocok)
   - Keywords diambil dari tabel `pengetahuans`

3. **Auto-Logging**
   - Jika tidak ada match di knowledge base → Log tersimpan otomatis
   - Data yang disimpan: question, user_ip, session_id
   - Status default: `is_resolved = false`

4. **Admin Management**
   - Admin bisa melihat semua pertanyaan yang tidak terjawab
   - Filter berdasarkan status penanganan
   - Menambahkan catatan admin
   - Menandai sebagai sudah ditangani
   - Menghapus log yang tidak relevan

## Testing

### Test 1: Pertanyaan Ada di Knowledge Base
```
Input: "Apa layanan yang ditawarkan?"
Expected: Tidak tercatat di log (ada di knowledge base)
```

### Test 2: Pertanyaan Tidak Ada di Knowledge Base
```
Input: "Berapa harga untuk pembuatan website e-commerce?"
Expected: Tercatat di chatbot_logs table
```

### Test 3: Admin View
```
URL: http://localhost/admin/chatbot-log
Expected: Menampilkan daftar pertanyaan yang tidak terjawab
```

## Database Query Example

```sql
-- Melihat semua log yang belum ditangani
SELECT * FROM chatbot_logs WHERE is_resolved = 0 ORDER BY created_at DESC;

-- Melihat log berdasarkan IP tertentu
SELECT * FROM chatbot_logs WHERE user_ip = '127.0.0.1';

-- Count pertanyaan yang sering ditanya
SELECT question, COUNT(*) as total 
FROM chatbot_logs 
GROUP BY question 
ORDER BY total DESC 
LIMIT 10;
```

## Maintenance

### Tambah Pertanyaan ke Knowledge Base
1. Buka menu "Log Chatbot" di admin
2. Lihat pertanyaan yang sering muncul
3. Tambahkan ke menu "Knowledge Base" (Pengetahuan)
4. Tandai log sebagai "Sudah Ditangani"

### Cleanup Old Logs
```php
// Hapus log yang sudah lebih dari 3 bulan
ChatbotLog::where('created_at', '<', now()->subMonths(3))->delete();
```

## Future Improvements
1. Auto-suggest: Saran otomatis untuk menambahkan ke knowledge base
2. Analytics: Dashboard untuk analisis pertanyaan paling sering
3. Export: Export log ke CSV/Excel
4. Notification: Email notification ke admin jika ada pertanyaan baru
5. Bulk Actions: Mark multiple logs sebagai resolved

## Dependencies
- Laravel 10.x
- OpenAI PHP Client
- AdminLTE 3
- jQuery
- Moment.js
- SweetAlert2

---
**Created**: 21 November 2025
**Author**: GitHub Copilot
**Status**: ✅ Implemented & Tested
