<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - Litera</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="min-h-screen flex items-center justify-center p-4"
    style="background: linear-gradient(135deg, #FDFCF7 0%, #D9D7CB 100%);">

    @php
        $email = session('otp_email');
        $username = substr($email, 0, 3);
        $domain = substr($email, strpos($email, '@'));
    @endphp

    <div class="w-full max-w-md relative z-10">
        <!-- Card with dramatic shadow -->
        <div class="bg-white backdrop-filter backdrop-blur-lg rounded-3xl shadow-2xl p-8 md:p-10 border border-opacity-20"
            style="border-color: #C8C5BC; box-shadow: 0 20px 60px rgba(0,0,0,0.08);">

            <!-- Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl mb-4"
                    style="background: linear-gradient(135deg, #C8C5BC, #D9D7CB);">
                    <i class="fas fa-shield-alt text-white text-2xl"></i>
                </div>
                <h1 class="text-4xl font-bold tracking-tight" style="color: #2D2D2D;">Verifikasi OTP</h1>
                <p class="mt-2 text-sm" style="color: #7F7F7F;">Masukkan kode OTP yang telah dikirim</p>
            </div>

            <!-- Alerts -->
            @if (session('error'))
                <div
                    class="mb-4 p-4 rounded-xl bg-red-50 border-l-4 border-red-500 flex items-start gap-3 animate-slideIn">
                    <i class="fas fa-exclamation-circle text-red-600 mt-0.5"></i>
                    <span class="text-sm text-red-800">{{ session('error') }}</span>
                </div>
            @endif

            @if (session('success'))
                <div
                    class="mb-4 p-4 rounded-xl bg-green-50 border-l-4 border-green-500 flex items-start gap-3 animate-slideIn">
                    <i class="fas fa-check-circle text-green-600 mt-0.5"></i>
                    <span class="text-sm text-green-800">{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-4 rounded-xl bg-red-50 border-l-4 border-red-500 animate-slideIn">
                    <p class="text-sm text-red-800 flex items-start gap-2">
                        <i class="fas fa-triangle-exclamation mt-0.5 flex-shrink-0"></i>
                        <span>{{ $errors->first() }}</span>
                    </p>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('verify.otp') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">

                <div>
                    <label for="otp" class="block text-sm font-semibold mb-3" style="color: #2D2D2D;">Kode OTP 6
                        Digit</label>
                    <div class="flex gap-2 justify-between">
                        @for ($i = 1; $i <= 6; $i++)
                            <input type="text"
                                class="w-12 h-14 text-center text-2xl font-bold rounded-xl border-2 transition-all focus:outline-none focus:scale-110"
                                style="border-color: #E0DED4; background: #FDFCF7;" maxlength="1" pattern="\d"
                                inputmode="numeric" data-index="{{ $i }}">
                        @endfor
                    </div>
                    <input type="hidden" id="otp" name="otp" value="">
                </div>

                <div class="text-center text-xs" style="color: #A0A0A0;">
                    <p>Kode OTP dikirim ke email Anda</p>
                    <p class="mt-1">{{ $username }}***{{ $domain }}</p>
                </div>

                <button type="submit"
                    class="w-full py-3 px-4 rounded-xl font-semibold text-white transition-all duration-300 transform hover:scale-105 hover:shadow-lg active:scale-95 flex items-center justify-center gap-2 text-base"
                    style="background: linear-gradient(135deg, #C8C5BC, #B5B1A5);">
                    <i class="fas fa-check-circle"></i> Verifikasi OTP
                </button>
            </form>

            <!-- Resend OTP -->
            <div class="mt-4 text-center">
                <p class="text-sm" style="color: #7F7F7F;">
                    {{-- Tidak menerima kode?
                    <a href="#" class="font-semibold transition-colors hover:underline" style="color: #C8C5BC;"
                        onclick="resendOTP(event)">Kirim ulang</a> --}}
                <form action="{{ route('verify.otp.resend') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-link">Kirim Ulang OTP</button>
                </form>
                </p>
            </div>
        </div>

        <p class="text-center text-xs mt-8" style="color: #A0A0A0;">© 2025 Litera. Semua hak dilindungi.</p>
    </div>

    <style>
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slideIn {
            animation: slideIn 0.3s ease-out;
        }

        input[type="text"]:focus {
            box-shadow: 0 0 0 3px rgba(200, 197, 188, 0.1);
            border-color: #C8C5BC;
        }

        input[data-index]::-webkit-outer-spin-button,
        input[data-index]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        @media (max-width: 640px) {
            body {
                background: #FDFCF7;
            }

            .flex.gap-2 {
                gap: 0.5rem;
            }

            input.w-12 {
                width: 2.5rem;
            }
        }
    </style>

    <script>
        const otpInputs = document.querySelectorAll('input[data-index]');
        const otpField = document.getElementById('otp');

        otpInputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                if (e.target.value && !/^\d$/.test(e.target.value)) {
                    e.target.value = '';
                    return;
                }
                if (e.target.value && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
                updateOTPField();
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    otpInputs[index - 1].focus();
                }
            });
        });

        function updateOTPField() {
            otpField.value = Array.from(otpInputs).map(i => i.value).join('');
        }

        function resendOTP(e) {
            e.preventDefault();
            alert('Kode OTP akan dikirim ulang ke email Anda dalam beberapa saat.');
        }
    </script>

</body>

</html>
