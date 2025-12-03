<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Litera</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="min-h-screen bg-white">

    <div class="flex min-h-screen">

        <!-- LEFT PANEL - Decorative -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden items-center justify-center p-8"
            style="background: linear-gradient(135deg, #a78bfa 0%, #06B6D4 50%, #fbbf24 100%);">

            <!-- Decorative circles/blobs -->
            <div class="absolute top-20 left-10 w-40 h-40 rounded-full opacity-20"
                style="background: #ffffff; filter: blur(40px);"></div>
            <div class="absolute bottom-32 right-10 w-56 h-56 rounded-full opacity-25"
                style="background: #1E1B4B; filter: blur(50px);"></div>

            <!-- Wave decoration -->
            <svg class="absolute top-0 right-0 w-full h-full opacity-10" viewBox="0 0 1000 1000"
                preserveAspectRatio="none">
                <path d="M0,300 Q250,200 500,300 T1000,300 L1000,0 L0,0 Z" fill="#1E1B4B"></path>
            </svg>

            <!-- Content -->
            <div class="relative z-10 text-center text-white max-w-md">
                <div class="mb-8 flex justify-center">
                    <div class="w-20 h-20 rounded-3xl flex items-center justify-center"
                        style="background: linear-gradient(135deg, #06B6D4, #0891B2); box-shadow: 0 10px 30px rgba(6, 182, 212, 0.3);">
                        <i class="fas fa-book text-4xl"></i>
                    </div>
                </div>
                <h2 class="text-5xl md:text-6xl font-bold leading-tight mb-4">Bergabunglah<br>Sekarang!</h2>
                <p class="text-lg opacity-90">Buat akun baru dan mulai perjalanan belajar Anda hari ini</p>
            </div>
        </div>

        <!-- RIGHT PANEL - Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-4 md:p-8 min-h-screen lg:min-h-auto overflow-y-auto"
            style="background: #F8FAFC;">

            <div class="w-full max-w-md">

                <!-- Mobile Header -->
                <div class="lg:hidden text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl mb-4"
                        style="background: linear-gradient(135deg, #1E1B4B, #06B6D4);">
                        <i class="fas fa-book text-white text-2xl"></i>
                    </div>
                    <h1 class="text-3xl font-bold" style="color: #1E1B4B;">Litera</h1>
                </div>

                <!-- Form Header -->
                <div class="mb-8">
                    <h3 class="text-3xl md:text-4xl font-bold" style="color: #1E1B4B;">Daftar</h3>
                    <p class="text-sm mt-2" style="color: #6B7280;">Buat akun baru untuk memulai</p>
                </div>

                <!-- Alerts -->
                @if (session('success'))
                    <div
                        class="mb-4 p-4 rounded-xl bg-green-50 border-l-4 border-green-500 flex items-start gap-3 animate-slideIn">
                        <i class="fas fa-check-circle text-green-600 mt-0.5"></i>
                        <span class="text-sm text-green-800">{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div
                        class="mb-4 p-4 rounded-xl bg-red-50 border-l-4 border-red-500 flex items-start gap-3 animate-slideIn">
                        <i class="fas fa-exclamation-circle text-red-600 mt-0.5"></i>
                        <span class="text-sm text-red-800">{{ session('error') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 p-4 rounded-xl bg-red-50 border-l-4 border-red-500 animate-slideIn">
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
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #1E1B4B;">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            placeholder="Masukkan nama Anda" required
                            class="w-full px-4 py-3 rounded-lg border-2 transition-all focus:outline-none focus:ring-2 focus:ring-offset-2"
                            style="border-color: #E5E7EB; background: #FFFFFF; color: #1F2937;">
                        <style>
                            input[type="text"]:focus {
                                border-color: #06B6D4 !important;
                                box-shadow: 0 0 0 3px rgba(6, 182, 212, 0.1) !important;
                            }
                        </style>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #1E1B4B;">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            placeholder="Masukkan email Anda" required
                            class="w-full px-4 py-3 rounded-lg border-2 transition-all focus:outline-none focus:ring-2 focus:ring-offset-2"
                            style="border-color: #E5E7EB; background: #FFFFFF; color: #1F2937;">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #1E1B4B;">Password</label>
                        <input type="password" name="password" placeholder="Minimal 8 karakter" required
                            class="w-full px-4 py-3 rounded-lg border-2 transition-all focus:outline-none focus:ring-2 focus:ring-offset-2"
                            style="border-color: #E5E7EB; background: #FFFFFF; color: #1F2937;">
                        <p class="mt-1 text-xs" style="color: #06B6D4;">
                            <i class="fas fa-info-circle"></i> Minimal 8 karakter, kombinasi huruf, angka, dan simbol
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #1E1B4B;">Konfirmasi
                            Password</label>
                        <input type="password" name="password_confirmation" placeholder="Ulangi password" required
                            class="w-full px-4 py-3 rounded-lg border-2 transition-all focus:outline-none focus:ring-2 focus:ring-offset-2"
                            style="border-color: #E5E7EB; background: #FFFFFF; color: #1F2937;">
                    </div>

                    <button type="submit"
                        class="w-full py-3 px-4 rounded-lg font-semibold text-white transition-all duration-300 transform hover:shadow-lg active:scale-95 flex items-center justify-center gap-2 text-base mt-6"
                        style="background: linear-gradient(135deg, #06B6D4, #0891B2); box-shadow: 0 4px 15px rgba(6, 182, 212, 0.3);">
                        <i class="fas fa-user-plus"></i> Daftar Sekarang
                    </button>
                </form>

                <!-- Divider -->
                <div class="my-6 flex items-center gap-3">
                    <div class="flex-1 h-px" style="background-color: #E5E7EB;"></div>
                    <span class="text-xs" style="color: #6B7280;">atau</span>
                    <div class="flex-1 h-px" style="background-color: #E5E7EB;"></div>
                </div>

                <!-- Login Link -->
                <div class="text-center">
                    <p class="text-sm" style="color: #1E1B4B;">Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-semibold hover:underline transition-colors"
                            style="color: #06B6D4;">Login di sini</a>
                    </p>
                </div>

            </div>
        </div>

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

        @media (max-width: 1024px) {
            .hidden.lg\:flex {
                display: none !important;
            }
        }
    </style>

</body>

</html>
