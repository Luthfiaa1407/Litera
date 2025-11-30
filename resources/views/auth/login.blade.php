<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Litera</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="min-h-screen flex items-center justify-center p-4"
    style="background: linear-gradient(135deg, #0F172A 0%, #1E1B4B 100%);">

    <!-- Cyan Glow Updated -->
    <div class="fixed top-0 right-0 w-96 h-96 rounded-full opacity-20"
        style="background: #06B6D4; filter: blur(70px); pointer-events: none;"></div>

    <div class="fixed bottom-0 left-0 w-80 h-80 rounded-full opacity-15"
        style="background: #EC4899; filter: blur(60px); pointer-events: none;"></div>

    <div class="w-full max-w-md relative z-10">

        <div class="bg-white backdrop-blur-lg rounded-3xl shadow-2xl p-8 md:p-10 border border-opacity-40"
            style="border-color: #06B6D4; box-shadow: 0 20px 60px rgba(6, 182, 212, 0.15);">

            <!-- Header -->
            <div class="text-center mb-8">
                <!-- Updated to Primary + Dark Primary -->
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl mb-4"
                    style="background: linear-gradient(135deg, #1E1B4B, #06B6D4);">
                    <i class="fas fa-book text-white text-2xl"></i>
                </div>
                <h1 class="text-4xl font-bold tracking-tight" style="color: #1E1B4B;">Litera</h1>
                <p class="mt-2 text-sm" style="color: #0891B2;">Selamat datang kembali</p>
            </div>

            <!-- Alerts -->
            @if (session('success'))
                <div
                    class="mb-4 p-4 rounded-xl bg-green-50 border-l-4 border-green-600 flex items-start gap-3 animate-slideIn">
                    <i class="fas fa-check-circle text-green-700 mt-0.5"></i>
                    <span class="text-sm text-green-800">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div
                    class="mb-4 p-4 rounded-xl bg-red-50 border-l-4 border-red-600 flex items-start gap-3 animate-slideIn">
                    <i class="fas fa-exclamation-circle text-red-700 mt-0.5"></i>
                    <span class="text-sm text-red-800">{{ session('error') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-4 rounded-xl bg-red-50 border-l-4 border-red-600 animate-slideIn">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm text-red-800 flex items-start gap-2">
                                <i class="fas fa-triangle-exclamation mt-0.5 flex-shrink-0"></i>
                                <span>{{ $error }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-semibold mb-2" style="color: #1E1B4B;">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        placeholder="Masukkan email Anda" required autofocus
                        class="w-full px-4 py-3 rounded-xl border-2 transition-all focus:outline-none focus:scale-105"
                        style="border-color: #06B6D4; background: #F8FAFC;">
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold mb-2"
                        style="color: #1E1B4B;">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required
                        class="w-full px-4 py-3 rounded-xl border-2 transition-all focus:outline-none focus:scale-105"
                        style="border-color: #06B6D4; background: #F8FAFC;">
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember" class="w-4 h-4 rounded cursor-pointer"
                        style="accent-color: #0891B2;">
                    <label for="remember" class="ml-2 text-sm cursor-pointer" style="color: #1E1B4B;">
                        Ingat saya di perangkat ini
                    </label>
                </div>

                <!-- Updated button gradient -->
                <button type="submit"
                    class="w-full py-3 px-4 rounded-xl font-semibold text-white transition-all duration-300 transform hover:scale-105 hover:shadow-lg active:scale-95 flex items-center justify-center gap-2 text-base"
                    style="background: linear-gradient(135deg, #1E1B4B, #06B6D4); box-shadow: 0 10px 25px rgba(6, 182, 212, 0.2);">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>

            <!-- Divider -->
            <div class="my-6 flex items-center gap-3">
                <div class="flex-1 h-px" style="background-color: #06B6D4;"></div>
                <span class="text-xs" style="color: #1E1B4B;">atau</span>
                <div class="flex-1 h-px" style="background-color: #06B6D4;"></div>
            </div>

            <div class="text-center">
                <p class="text-sm" style="color: #1E1B4B;">Belum punya akun?
                    <a href="{{ route('register.form') }}" class="font-semibold hover:underline"
                        style="color: #0891B2;">Daftar di sini</a>
                </p>
            </div>
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

        input:focus {
            box-shadow: 0 0 0 3px rgba(6, 182, 212, 0.2);
        }

        @media (max-width: 640px) {
            body {
                background: #0F172A;
            }
        }
    </style>

</body>

</html>
