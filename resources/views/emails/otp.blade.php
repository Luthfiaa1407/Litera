<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode OTP - Litera</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
            line-height: 1.6;
            color: #0F172A;
            background: linear-gradient(135deg, #06B6D4 0%, #0891B2 100%);
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #FFFFFF;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(6, 182, 212, 0.2);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #0891B2, #06B6D4);
            padding: 40px 20px;
            text-align: center;
            color: #FFFFFF;
        }

        .header-icon {
            display: inline-block;
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            line-height: 60px;
            font-size: 32px;
            margin-bottom: 16px;
        }

        .header h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .content {
            padding: 40px 30px;
        }

        .greeting {
            font-size: 16px;
            color: #0F172A;
            margin-bottom: 20px;
        }

        .greeting strong {
            color: #06B6D4;
        }

        .otp-section {
            margin: 30px 0;
            text-align: center;
        }

        .otp-label {
            display: block;
            font-size: 12px;
            color: #64748B;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 12px;
            font-weight: 600;
        }

        .otp-code {
            display: inline-block;
            background: #F0F9FF;
            border: 2px solid #06B6D4;
            border-radius: 16px;
            padding: 20px 40px;
            font-size: 36px;
            font-weight: 700;
            letter-spacing: 8px;
            color: #0F172A;
            font-family: 'Courier New', monospace;
            box-shadow: 0 8px 20px rgba(6, 182, 212, 0.2);
        }

        .info-box {
            background: #ECFEFF;
            border-left: 4px solid #06B6D4;
            border-radius: 8px;
            padding: 16px;
            margin: 30px 0;
            font-size: 14px;
            color: #0F172A;
        }

        .info-box strong {
            color: #0891B2;
        }

        .instructions {
            background: #E0F7FA;
            border-radius: 12px;
            padding: 24px;
            margin: 20px 0;
            font-size: 14px;
            color: #0F172A;
        }

        .instructions strong {
            color: #0891B2;
        }

        .instructions ol {
            margin-left: 20px;
        }

        .instructions li {
            margin-bottom: 10px;
        }

        .footer {
            border-top: 1px solid rgba(6, 182, 212, 0.2);
            padding: 30px;
            text-align: center;
            background: #F0F9FF;
        }

        .footer-text {
            font-size: 12px;
            color: #64748B;
            margin-bottom: 12px;
        }

        .brand {
            font-size: 14px;
            color: #0F172A;
            font-weight: 600;
        }

        .warning {
            font-size: 12px;
            color: #DC2626;
            margin-top: 16px;
            line-height: 1.5;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-icon">📖</div>
            <h1>Litera</h1>
            <p>Verifikasi Kode OTP Anda</p>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                Halo <strong>{{ $userName ?? 'Pengguna' }}</strong>,
            </div>

            <p style="color: #64748B; font-size: 14px; margin-bottom: 24px;">
                Kami menerima permintaan untuk memverifikasi akun Anda. Gunakan kode OTP di bawah ini untuk melanjutkan
                proses verifikasi.
            </p>

            <!-- OTP Section -->
            <div class="otp-section">
                <span class="otp-label">Kode Verifikasi Anda</span>
                <div class="otp-code">{{ $otp }}</div>
            </div>

            <!-- Info Box -->
            <div class="info-box">
                ⏱️ <strong>Kode ini berlaku selama 5 menit.</strong> Pastikan Anda menggunakannya sebelum kadaluarsa.
            </div>

            <!-- Instructions -->
            <div class="instructions">
                <strong style="margin-bottom: 12px;">Langkah-langkah verifikasi:</strong>
                <ol>
                    <li>Salin kode OTP di atas</li>
                    <li>Kembali ke aplikasi atau situs kami</li>
                    <li>Masukkan kode pada kolom verifikasi</li>
                    <li>Klik tombol "Verifikasi" untuk menyelesaikan proses</li>
                </ol>
            </div>

            <!-- Security Warning -->
            <div class="warning">
                🔒 <strong>Penting:</strong> Jangan pernah bagikan kode OTP ini kepada siapa pun, termasuk tim dukungan
                kami. Kami tidak akan pernah meminta kode OTP Anda melalui email atau pesan.
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-text">Jika Anda tidak merasa melakukan permintaan ini, abaikan email ini atau hubungi tim
                dukungan kami.</div>
            <div class="brand">{{ config('app.name', 'Litera') }}</div>
            <div class="footer-text" style="margin-top: 12px; font-size: 11px;">
                © {{ date('Y') }} {{ config('app.name', 'Litera') }}. Semua hak dilindungi.
            </div>
        </div>
    </div>
</body>

</html>
