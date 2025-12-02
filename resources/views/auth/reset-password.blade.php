<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Litera</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="min-h-screen flex items-center justify-center p-4"
    style="background: linear-gradient(135deg, #0F172A 0%, #1E1B4B 100%);">

    <!-- Glow Background -->
    <div class="fixed top-0 right-0 w-96 h-96 rounded-full opacity-20"
        style="background: #06B6D4; filter: blur(70px); pointer-events: none;"></div>
    <div class="fixed bottom-0 left-0 w-80 h-80 rounded-full opacity-15"
        style="background: #EC4899; filter: blur(60px); pointer-events: none;"></div>

    <div class="w-full max-w-md relative z-10">

        <div class="bg-white backdrop-blur-lg rounded-3xl shadow-2xl p-8 md:p-10 border border-opacity-40"
            style="border-color: #06B6D4; box-shadow: 0 20px 60px rgba(6, 182, 212, 0.15);">

            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl mb-4"
                    style="background: linear-gradient(135deg, #1E1B4B, #06B6D4);">
                    <i class="fas fa-key text-white text-2xl"></i>
                </div>
                <h1 class="text-3xl font-bold tracking-tight" style="color: #1E1B4B;">Reset Password</h1>
                <p class="mt-2 text-sm" style="color: #0891B2;">Silakan masukkan password baru Anda</p>
            </div>

            <!-- Error Alert -->
            @if ($errors->any())
                <div class="mb-4 p-4 rounded-xl bg-red-50 border-l-4 border-red-600 animate-slideIn">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm text-red-800 flex items-start gap-2">
                                <i class="fas fa-triangle-exclamation mt-0.5"></i> {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ request()->email }}">

                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: #1E1B4B;">Password Baru</label>
                    <input type="password" name="password" required placeholder="Masukkan password baru"
                        class="w-full px-4 py-3 rounded-xl border-2 transition-all focus:outline-none focus:scale-105"
                        style="border-color: #06B6D4; background: #F8FAFC;">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: #1E1B4B;">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required placeholder="Ulangi password baru"
                        class="w-full px-4 py-3 rounded-xl border-2 transition-all focus:outline-none focus:scale-105"
                        style="border-color: #06B6D4; background: #F8FAFC;">
                </div>

                <button type="submit"
                    class="w-full py-3 px-4 rounded-xl font-semibold text-white transition-all duration-300 hover:scale-105"
                    style="background: linear-gradient(135deg, #1E1B4B, #06B6D4);">
                    <i class="fas fa-check"></i> Reset Password
                </button>
            </form>

        </div>

        <p class="text-center text-xs mt-8" style="color: #0891B2;">© 2025 Litera. Semua hak dilindungi.</p>
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
    </style>
</body>

</html>
