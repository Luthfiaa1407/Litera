<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Litera</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="min-h-screen flex items-center justify-center p-4 py-8"
    style="background: linear-gradient(135deg, #0F172A 0%, #1E1B4B 100%);">

    <!-- Updated decorative elements with cyan and pink gradients -->
    <div class="fixed top-0 right-0 w-96 h-96 rounded-full opacity-20" style="background: #0EA5E9; filter: blur(70px);">
    </div>
    <div class="fixed bottom-0 left-0 w-80 h-80 rounded-full opacity-15"
        style="background: #EC4899; filter: blur(60px);"></div>

    <div class="w-full max-w-md relative z-10">

        <!-- Card -->
        <div class="bg-white rounded-3xl shadow-2xl p-8 md:p-10 border border-opacity-40"
            style="border-color: #0EA5E9; box-shadow: 0 20px 60px rgba(14, 165, 233, 0.15);">

            <div class="text-center mb-8">
                <!-- Updated icon gradient with indigo and cyan -->
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl mb-4"
                    style="background: linear-gradient(135deg, #1E1B4B, #0EA5E9);">
                    <i class="fas fa-book text-white text-2xl"></i>
                </div>
                <h1 class="text-4xl font-bold tracking-tight" style="color: #1E1B4B;">Litera</h1>
                <p class="mt-2 text-sm" style="color: #0EA5E9;">Buat akun baru Anda</p>
            </div>

            <!-- Alerts -->
            @if (session('success'))
                <div
                    class="mb-4 p-4 rounded-xl bg-green-50 border-l-4 border-green-500 flex items-start gap-3 animate-slideIn">
                    <i class="fas fa-check-circle text-green-600"></i>
                    <span class="text-sm text-green-800">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div
                    class="mb-4 p-4 rounded-xl bg-red-50 border-l-4 border-red-500 flex items-start gap-3 animate-slideIn">
                    <i class="fas fa-exclamation-circle text-red-600"></i>
                    <span class="text-sm text-red-800">{{ session('error') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-4 rounded-xl bg-red-50 border-l-4 border-red-500 animate-slideIn">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm text-red-800 flex items-start gap-2">
                                <i class="fas fa-triangle-exclamation"></i>
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
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama Anda"
                        required
                        class="w-full px-4 py-3 rounded-xl border-2 focus:outline-none focus:scale-105 transition-all"
                        style="border-color: #0EA5E9; background: #F8FAFC;">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: #1E1B4B;">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email Anda"
                        required
                        class="w-full px-4 py-3 rounded-xl border-2 focus:outline-none focus:scale-105 transition-all"
                        style="border-color: #0EA5E9; background: #F8FAFC;">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: #1E1B4B;">Password</label>
                    <input type="password" name="password" placeholder="Minimal 8 karakter" required
                        class="w-full px-4 py-3 rounded-xl border-2 focus:outline-none focus:scale-105 transition-all"
                        style="border-color: #0EA5E9; background: #F8FAFC;">
                    <p class="mt-1 text-xs" style="color: #0EA5E9;">
                        <i class="fas fa-info-circle"></i> Minimal 8 karakter
                    </p>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: #1E1B4B;">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" placeholder="Ulangi password" required
                        class="w-full px-4 py-3 rounded-xl border-2 focus:outline-none focus:scale-105 transition-all"
                        style="border-color: #0EA5E9; background: #F8FAFC;">
                </div>

                <!-- Updated button gradient with indigo and cyan -->
                <button type="submit"
                    class="w-full py-3 px-4 rounded-xl font-semibold text-white flex items-center justify-center gap-2 hover:scale-105 active:scale-95 transition-all mt-6"
                    style="background: linear-gradient(135deg, #1E1B4B, #0EA5E9); box-shadow: 0 10px 25px rgba(14, 165, 233, 0.2);">
                    <i class="fas fa-user-plus"></i> Daftar Sekarang
                </button>
            </form>

            <div class="my-6 flex items-center gap-3">
                <div class="flex-1 h-px" style="background-color: #0EA5E9;"></div>
                <span class="text-xs" style="color: #1E1B4B;">atau</span>
                <div class="flex-1 h-px" style="background-color: #0EA5E9;"></div>
            </div>

            <div class="text-center">
                <p class="text-sm" style="color: #1E1B4B;">Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-semibold hover:underline" style="color: #0EA5E9;">Login
                        di sini</a>
                </p>
            </div>
        </div>

        <p class="text-center text-xs mt-8" style="color: #0EA5E9;">© 2025 Litera. Semua hak dilindungi.</p>
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
