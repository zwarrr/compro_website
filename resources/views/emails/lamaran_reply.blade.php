<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Undangan Interview</title>
  <style>
    /* Reset */
    body {
      margin: 0;
      padding: 0;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
      background-color: #f5f5f5;
      line-height: 1.6;
    }
    
    table {
      border-spacing: 0;
      border-collapse: collapse;
    }
    
    img {
      border: 0;
      display: block;
    }

    /* Container */
    .email-container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #ffffff;
    }

    /* Header */
    .header {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      padding: 40px 30px;
      text-align: center;
    }

    .header h1 {
      margin: 0;
      color: #ffffff;
      font-size: 28px;
      font-weight: 600;
      letter-spacing: -0.5px;
    }

    .header p {
      margin: 8px 0 0 0;
      color: rgba(255, 255, 255, 0.9);
      font-size: 15px;
    }

    /* Content */
    .content {
      padding: 40px 30px;
    }

    .greeting {
      font-size: 16px;
      color: #1a1a1a;
      margin: 0 0 20px 0;
    }

    .greeting strong {
      color: #667eea;
      font-weight: 600;
    }

    .intro-text {
      font-size: 15px;
      color: #4a4a4a;
      margin: 0 0 30px 0;
      line-height: 1.7;
    }

    /* Info Box */
    .info-box {
      background: #f8f9ff;
      border-radius: 12px;
      padding: 24px;
      margin: 0 0 30px 0;
      border-left: 4px solid #667eea;
    }

    .info-item {
      margin: 0 0 16px 0;
    }

    .info-item:last-child {
      margin: 0;
    }

    .info-label {
      font-size: 13px;
      color: #667eea;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin: 0 0 6px 0;
    }

    .info-value {
      font-size: 16px;
      color: #1a1a1a;
      font-weight: 500;
      margin: 0;
    }

    /* Notes Box */
    .notes-box {
      background: #fffbf0;
      border-radius: 12px;
      padding: 20px 24px;
      margin: 0 0 30px 0;
      border-left: 4px solid #fbbf24;
    }

    .notes-title {
      font-size: 13px;
      color: #f59e0b;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin: 0 0 12px 0;
    }

    .notes-content {
      font-size: 15px;
      color: #4a4a4a;
      line-height: 1.7;
      margin: 0;
    }

    /* Closing Text */
    .closing-text {
      font-size: 15px;
      color: #4a4a4a;
      margin: 0 0 30px 0;
      line-height: 1.7;
    }

    /* Divider */
    .divider {
      height: 1px;
      background: linear-gradient(to right, transparent, #e5e7eb 50%, transparent);
      margin: 30px 0;
    }

    /* Footer */
    .footer {
      background: #fafafa;
      padding: 30px;
      text-align: center;
      border-top: 1px solid #e5e7eb;
    }

    .footer-company {
      font-size: 16px;
      color: #1a1a1a;
      font-weight: 600;
      margin: 0 0 4px 0;
    }

    .footer-dept {
      font-size: 14px;
      color: #667eea;
      margin: 0 0 16px 0;
    }

    .footer-note {
      font-size: 13px;
      color: #9ca3af;
      margin: 0;
      line-height: 1.6;
    }

    /* Responsive */
    @media only screen and (max-width: 600px) {
      .header {
        padding: 30px 20px;
      }
      
      .header h1 {
        font-size: 24px;
      }
      
      .content {
        padding: 30px 20px;
      }
      
      .info-box, .notes-box {
        padding: 20px;
      }
      
      .footer {
        padding: 25px 20px;
      }
    }
  </style>
</head>
<body>
  <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td style="padding: 20px 0;">
        <table role="presentation" class="email-container" width="100%" cellpadding="0" cellspacing="0">
          
          <!-- Header -->
          <tr>
            <td class="header">
              <h1>🎯 Undangan Interview</h1>
              <p>{{ $perusahaan }}</p>
            </td>
          </tr>

          <!-- Content -->
          <tr>
            <td class="content">
              <p class="greeting">Halo <strong>{{ $nama }}</strong>,</p>
              
              <p class="intro-text">
                Kami dengan senang hati mengundang Anda untuk mengikuti tahap interview di <strong>{{ $perusahaan }}</strong>. Ini adalah kesempatan bagi kami untuk saling mengenal lebih dekat.
              </p>

              <!-- Info Box -->
              <div class="info-box">
                <div class="info-item">
                  <p class="info-label">📅 Tanggal & Waktu</p>
                  <p class="info-value">{{ $tanggal }}</p>
                </div>
              </div>

              <!-- Notes Box -->
              <div class="notes-box">
                <p class="notes-title">💬 Catatan Penting</p>
                <div class="notes-content">{!! nl2br(e($catatan)) !!}</div>
              </div>

              <p class="closing-text">
                Mohon konfirmasi kehadiran Anda atau hubungi kami jika ada pertanyaan. Kami sangat menantikan kehadiran Anda!
              </p>

              <div class="divider"></div>

              <p class="closing-text" style="margin: 0; font-size: 14px;">
                Salam hangat,<br>
                <strong>Tim HRD {{ $perusahaan }}</strong>
              </p>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td class="footer">
              <p class="footer-company">{{ $perusahaan }}</p>
              <p class="footer-dept">Human Resources Department</p>
              <p class="footer-note">
                Email ini dikirim secara otomatis.<br>
                Mohon tidak membalas langsung ke email ini.
              </p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>
</html>