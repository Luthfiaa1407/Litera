<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode OTP & Reset Password - Litera</title>

    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
            background: #e0faff;
            padding: 20px;
            margin: 0;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(6, 182, 212, 0.2);
        }

        .header {
            background: linear-gradient(135deg, #0891B2, #06B6D4);
            padding: 35px 20px;
            text-align: center;
            color: white;
        }

        .header-icon {
            background: rgba(255, 255, 255, 0.2);
            width: 60px;
            height: 60px;
            border-radius: 16px;
            line-height: 60px;
            margin: auto;
            font-size: 32px;
        }

        .content {
            padding: 40px 30px;
        }

        .otp-code {
            display: inline-block;
            padding: 20px 40px;
            font-size: 36px;
            background: #F0F9FF;
            border: 2px solid #06B6D4;
            border-radius: 16px;
            font-weight: bold;
            letter-spacing: 8px;
            font-family: 'Courier New', monospace;
            margin: 25px auto;
        }

        .reset-btn {
            display: inline-block;
            margin-top: 25px;
            padding: 14px 28px;
            background: #0ea5e9;
            color: white !important;
            text-decoration: none;
            font-weight: bold;
            border-radius: 12px;
            font-size: 15px;
        }

        .info-box {
            background: #ECFEFF;
            border-left: 4px solid #06B6D4;
            padding: 16px;
            border-radius: 8px;
            margin: 25px 0;
        }

        .warning {
            font-size: 12px;
            color: #DC2626;
            margin-top: 20px;
        }

        .footer {
            background: #F0F9FF;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #64748B;
        }
    </style>

</head>

<body>

    <div class="container">

        <!-- Header -->
        <div class="header">
            <div class="header-icon">📖</div>
            <h2 style="margin-top: 10px;">Litera</h2>
            <p style="opacity: 0.9;">Kode OTP & Reset Password</p>
        </div>

        <!-- Content -->
        <div class="content">

            <p>Halo <strong>{{ $userName ?? 'Pengguna' }}</strong>,</p>

            <p style="color:#475569">
                Kami menerima permintaan untuk memverifikasi akun serta mereset password Anda.
                Gunakan kode OTP berikut:
            </p>

            <div style="text-align:center;">
                <div class="otp-code">{{ $otp }}</div>
            </div>

            <div class="info-box">
                ⏱️ <strong>Kode OTP berlaku 5 menit.</strong>
                Jangan bagikan kode ini kepada siapa pun.
            </div>

            <p style="color:#475569; margin-top:25px;">
                Anda juga dapat mengganti password menggunakan tombol berikut:
            </p>

            <div style="text-align:center;">
                <a href="{{ $resetUrl }}" class="reset-btn">
                    Reset Password
                </a>
            </div>

            <p class="warning">
                Jika Anda tidak meminta permintaan ini, cukup abaikan email ini.
            </p>

        </div>

        <!-- Footer -->
        <div class="footer">
            © {{ date('Y') }} {{ config('app.name', 'Litera') }} — Semua hak dilindungi.
        </div>
    </div>

</body>

</html>
