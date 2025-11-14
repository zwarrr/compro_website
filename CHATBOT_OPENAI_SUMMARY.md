# 🤖 Chatbot OpenAI Integration - Summary

## ✅ Yang Sudah Dibuat

### 1. **Config File** (`config/openai.php`)
- Konfigurasi OpenAI API
- Model: GPT-4 Turbo
- Temperature: 0.9
- Max Tokens: 600
- Timeout: 30 detik

### 2. **Service Class** (`app/Services/OpenAIService.php`)
**Fitur Utama:**
- ✅ Integrasi dengan OpenAI API
- ✅ Membaca knowledge base dari tabel `pengetahuans`
- ✅ Inject knowledge base ke system prompt
- ✅ Inject waktu real-time (WIB)
- ✅ Conversation history (last 10 messages)
- ✅ Clean markdown formatting
- ✅ SSL bypass untuk development
- ✅ Error handling

**Methods:**
- `chat($message, $conversationHistory)` - Main method untuk chat
- `getKnowledgeBase()` - Ambil data dari tabel pengetahuans
- `buildMessages()` - Build message array dengan knowledge base
- `cleanMarkdown()` - Remove markdown formatting
- `testConnection()` - Test OpenAI connection

### 3. **Controller** (`app/Http/Controllers/ChatbotController.php`)
**Endpoints:**
- `POST /api/chatbot/send` - Kirim pesan ke AI
- `GET /api/chatbot/test` - Test koneksi OpenAI

**Validation:**
- Message: required, string, max 1000 characters
- Conversation history: optional, array

### 4. **Routes** (`routes/api.php`)
```php
POST /api/chatbot/send
GET  /api/chatbot/test
```

### 5. **Middleware Update** (`app/Http/Middleware/VerifyCsrfToken.php`)
- Exclude `api/*` dari CSRF verification

### 6. **Environment Variables** (`.env`)
```env
OPENAI_API_KEY=sk-proj-xxx...
OPENAI_ORGANIZATION=
OPENAI_MODEL=gpt-4-turbo
OPENAI_TEMPERATURE=0.9
OPENAI_MAX_TOKENS=600
OPENAI_TIMEOUT=30
OPENAI_SYSTEM_PROMPT="Kamu adalah TechAI..."
```

### 7. **Frontend Modal** (`resources/views/partials/modalchatbot.blade.php`)
**Perubahan:**
- ❌ Hapus sistem pilihan kategori/subkategori
- ✅ Tambah field input text langsung
- ✅ Integrasi dengan `/api/chatbot/send`
- ✅ Conversation history (last 20 messages)

**Smart Features:**
- ✅ **Auto-Close Modal**: Tutup otomatis 3 detik setelah AI respons jika user bilang kata penutup
- ✅ **Empty Message Validation**: Modal warning jika user coba kirim pesan kosong
- ✅ **Character Limit**: Maksimal 250 karakter per pesan dengan visual indicator
  - Normal (0-150): Abu-abu
  - Warning (150-200): Kuning + text warning
  - Critical (200-250): Merah + emoji ⚠️
- ✅ **Error Handling**: Pesan error yang user-friendly jika koneksi gagal
- ✅ **Thinking Indicator**: "TechAI sedang memproses..." dengan animated dots

**Auto-Close Keywords (11 kata):**
Modal akan otomatis tertutup 3 detik setelah AI merespons jika user mengetik:
1. `close` - "close aja"
2. `tutup` - "tutup ya"
3. `keluar` - "keluar dulu"
4. `exit` - "exit chat"
5. `bye` - "bye bye"
6. `selesai` - "udah selesai"
7. `cukup` - "udah cukup"
8. `stop` - "stop dulu"
9. `sudah` - "sudah ya"
10. `oke cukup` - "oke cukup deh"
11. `udah ah` - "udah ah close"

**Note**: Kata "makasih" dan "thanks" TIDAK trigger auto-close agar user bisa lanjut chat.

**Other Features:**
- Real-time chat dengan AI
- Context-aware conversation
- Auto scroll to bottom
- Smooth animations
- XSS protection
- Character counter dengan color coding

---

## 🎯 Cara Kerja Sistem

### Flow Chatbot:

```
1. User buka modal chat
   ↓
2. User ketik pesan
   ↓
3. Frontend kirim ke /api/chatbot/send dengan:
   - message: pesan user
   - conversation_history: 10 pesan terakhir
   ↓
4. ChatbotController validate input
   ↓
5. OpenAIService:
   a. Ambil data dari tabel pengetahuans
   b. Build system prompt + knowledge base
   c. Inject waktu real-time (WIB)
   d. Tambah conversation history
   e. Kirim ke OpenAI API
   ↓
6. OpenAI GPT-4 Turbo process dengan knowledge base
   ↓
7. Clean markdown dari response
   ↓
8. Return JSON response ke frontend
   ↓
9. Tampilkan response di chat bubble
   ↓
10. Check auto-close keywords
    - Jika ada: tutup modal setelah 3 detik
    - Jika tidak: continue chat
```

### Knowledge Base Integration:

```
Tabel: pengetahuans
Kolom yang digunakan:
- kategori_pertanyaan
- sub_kategori  
- jawaban

Format ke AI:
---
Kategori: Web Development
Sub Kategori: Laravel
Jawaban: Laravel adalah framework PHP...
---
Kategori: Hosting
Sub Kategori: VPS
Jawaban: VPS adalah Virtual Private Server...
---
```

AI akan menggunakan knowledge base ini untuk menjawab pertanyaan user.

---

## 📝 Cara Testing

### 1. Test Koneksi OpenAI
```bash
# Via browser
http://localhost:8000/api/chatbot/test

# Via cURL (PowerShell)
curl http://localhost:8000/api/chatbot/test
```

Expected response:
```json
{
  "success": true,
  "message": "OpenAI connection successful",
  "model": "gpt-4-turbo"
}
```

### 2. Test Chat via cURL
```powershell
$body = @{
    message = "Apa itu Laravel?"
    conversation_history = @()
} | ConvertTo-Json

Invoke-WebRequest -Uri "http://localhost:8000/api/chatbot/send" -Method POST -Body $body -ContentType "application/json"
```

### 3. Test via Browser
1. Buka homepage
2. Klik tombol chat (kanan bawah)
3. Ketik: "Halo"
4. Lihat response AI
5. Lanjut chat dengan konteks

### 4. Test Knowledge Base
1. Tambah data di tabel `pengetahuans`:
```sql
INSERT INTO pengetahuans (kode_pengetahuan, kategori_pertanyaan, sub_kategori, jawaban, created_at, updated_at) 
VALUES ('PGT001', 'Layanan', 'Hosting', 'Kami menyediakan shared hosting mulai Rp 15.000/bulan dengan uptime 99.9%', NOW(), NOW());
```

2. Chat: "Apa layanan hosting yang tersedia?"
3. AI akan jawab berdasarkan data di knowledge base

### 5. Test Auto-Close
Ketik salah satu keyword:
- "bye"
- "tutup"
- "close"
- "exit"
- "selesai"

AI akan respond, lalu modal otomatis close setelah 3 detik.

---

## 🔧 Troubleshooting

### Problem 1: SSL Certificate Error
**Solution:**
```php
// Di OpenAIService.php sudah di-set:
$this->http = Http::withOptions(['verify' => false]);
```

### Problem 2: API Key Invalid
**Check:**
```bash
php artisan tinker
>>> config('openai.api_key')
```

**Fix:**
1. Pastikan `.env` sudah benar
2. Run: `php artisan config:clear`

### Problem 3: Response Kosong
**Check:**
1. Cek tabel `pengetahuans` ada data
2. Cek log: `storage/logs/laravel.log`
3. Test connection: `/api/chatbot/test`

### Problem 4: CORS Error
**Fix:**
Routes sudah di-exclude dari CSRF di `VerifyCsrfToken.php`

### Problem 5: Timeout
**Increase timeout:**
```env
OPENAI_TIMEOUT=60
```

---

## 💰 Cost Estimation

**Model:** GPT-4 Turbo
**Pricing:**
- Input: $10/1M tokens
- Output: $30/1M tokens

**Average per chat:**
- ~200 tokens input (dengan knowledge base)
- ~200 tokens output
- Cost: ~$0.008 per chat (Rp 120)

**Monthly estimates:**
- 100 chats/day = ~$24/month
- 500 chats/day = ~$120/month

**Tips hemat:**
1. Gunakan `gpt-4o-mini` (90% lebih murah)
2. Kurangi `max_tokens` jadi 300
3. Batasi conversation history

---

## 🔒 Security Checklist

- [x] API key di `.env` (not in code)
- [x] `.env` in `.gitignore`  
- [x] Input validation (max 1000 chars)
- [x] XSS protection (escapeHtml)
- [x] CSRF exclusion untuk API
- [x] Error messages sanitized
- [x] Conversation history limited (10 msgs)

---

## 📚 Next Steps

### Optional Enhancements:

1. **Rate Limiting**
```php
// routes/api.php
Route::middleware('throttle:60,1')->post('/chatbot/send', ...);
```

2. **Save Conversation to DB**
```php
// Create conversations table
// Save user + AI messages
```

3. **Analytics**
```php
// Track: message count, response time, topics
```

4. **Multi-Language**
```php
// Add language detection
// Customize response language
```

5. **Custom Knowledge by Category**
```php
// Filter knowledge base by category
// More targeted responses
```

---

## 📞 Support

**Issues?**
1. Check logs: `storage/logs/laravel.log`
2. Test connection: `/api/chatbot/test`
3. Verify API key: https://platform.openai.com/api-keys
4. Check quota: https://platform.openai.com/usage

**Status:** ✅ Ready to Use!
**Version:** 1.0
**Last Updated:** November 13, 2025
