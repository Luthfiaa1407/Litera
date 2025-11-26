<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Kode OTP</title>
</head>
<body>
    <h2>Kode OTP Anda</h2>
    <p>Gunakan kode OTP berikut untuk verifikasi:</p>

    <h1 style="font-size: 32px; font-weight:bold; letter-spacing:5px;">
        {{ $otp }}
    </h1>

    <p>Kode ini berlaku 5 menit.</p>

    <p>Terima kasih,<br>{{ config('app.name') }}</p>
</body>
</html>
