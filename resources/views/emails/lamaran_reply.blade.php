<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Balasan HRD</title>
  <style>
    body { font-family: Arial, Helvetica, sans-serif; color: #333; }
    .container { max-width: 600px; margin: 0 auto; padding: 20px; }
    .header { background:#0d6efd; color:#fff; padding:10px 15px; border-radius:6px 6px 0 0 }
    .content { border:1px solid #e5e7eb; padding:15px; }
    .footer { font-size:12px; color:#666; margin-top:10px }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h2>Informasi Interview</h2>
    </div>
    <div class="content">
      <p>Halo {{ $nama }},</p>
      <p>Kami dari <strong>{{ $perusahaan }}</strong> mengundang Anda untuk interview:</p>
      <p><strong>Tanggal:</strong> {{ $tanggal }}</p>
      <p><strong>Catatan HRD:</strong></p>
      <div style="background:#f8f9fa;padding:10px;border-radius:4px">{!! nl2br(e($catatan)) !!}</div>
      <p>Silakan konfirmasi kehadiran atau hubungi kami jika ada pertanyaan.</p>
    </div>
    <div class="footer">
      <p>Terima kasih,<br>{{ $perusahaan }}</p>
    </div>
  </div>
</body>
</html>
