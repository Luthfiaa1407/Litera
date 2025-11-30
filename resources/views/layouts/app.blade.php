<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Litera') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        * {
            font-family: "Poppins", sans-serif;
        }

        /* 🎨 PALET WARNA BARU */
        :root {
            --color-primary: #06B6D4;
            --color-primary-dark: #0891B2;
            --color-accent: #0891B2;
            --color-bg: #FFFFFF;
            --color-light-bg: #F0F9FF;

            --color-text: #1F2937;
            --color-light-text: #475569;
        }

        body {
            background: var(--color-bg);
            color: var(--color-text);
        }

        .nav-link-item {
            transition: 0.3s ease;
            position: relative;
            color: var(--color-primary-dark);
        }

        .nav-link-item:hover {
            color: var(--color-primary) !important;
            transform: translateY(-2px);
        }

        .nav-link-item:hover::after {
            content: "";
            position: absolute;
            bottom: -4px;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 3px;
            background: var(--color-primary);
            border-radius: 2px;
            box-shadow: 0 0 12px rgba(6, 182, 212, 0.6);
        }

        .active-bg {
            background: var(--color-primary);
            color: #FFFFFF !important;
            box-shadow: 0 4px 16px rgba(6, 182, 212, 0.4);
            border-radius: 12px;
            padding: 8px 14px !important;
        }

        .glass-header {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(16px);
            border-bottom: 2px solid var(--color-primary);
            box-shadow: 0 4px 20px rgba(6, 182, 212, 0.12);
        }

        footer {
            background: linear-gradient(135deg, var(--color-primary-dark), var(--color-primary));
            color: #FFFFFF;
            border-top: 3px solid var(--color-primary);
        }
    </style>
</head>

<body>

    <header class="glass-header">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">

                <!-- Brand -->
                <div class="text-3xl font-bold flex items-center gap-2" style="color: var(--color-primary-dark);">
                    <i class="fas fa-book"></i> Litera
                </div>

                <!-- DESKTOP NAV -->
                <div class="hidden md:flex items-center gap-8">
                    @auth
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}"
                                class="nav-link-item text-sm tracking-wide px-3 py-2 rounded-lg
                                {{ request()->routeIs('admin.dashboard') ? 'active-bg' : '' }}">
                                Dashboard
                            </a>

                            <a href="{{ route('admin.borrows.pending') }}"
                                class="nav-link-item text-sm px-3 py-2 rounded-lg
                                {{ request()->routeIs('admin.borrows.*') ? 'active-bg' : '' }}">
                                Pending Request
                            </a>


                            <a href="{{ route('admin.users.index') }}"
                                class="nav-link-item text-sm px-3 py-2 rounded-lg
                                {{ request()->routeIs('admin.users.*') ? 'active-bg' : '' }}">
                                Kelola User
                            </a>

                            <a href="{{ route('admin.books.index') }}"
                                class="nav-link-item text-sm px-3 py-2 rounded-lg
                                {{ request()->routeIs('admin.books.*') ? 'active-bg' : '' }}">
                                Kelola Buku
                            </a>

                            <a href="{{ route('admin.categories.index') }}"
                                class="nav-link-item text-sm px-3 py-2 rounded-lg
                                {{ request()->routeIs('admin.categories.*') ? 'active-bg' : '' }}">
                                Kelola Kategori
                            </a>

                            <a href="{{ route('logout') }}" class="text-sm tracking-wide px-4 py-2 rounded-lg text-white"
                                style="background: var(--color-primary-dark); box-shadow: 0 10px 25px rgba(6, 182, 212, 0.2);">
                                Logout
                            </a>
                        @elseif(Auth::user()->role === 'pengguna')
                            <a href="{{ route('user.dashboard') }}"
                                class="nav-link-item text-sm px-3 py-2 rounded-lg
                                {{ request()->routeIs('user.dashboard') ? 'active-bg' : '' }}">
                                Dashboard
                            </a>

                            <a href="{{ route('user.books') }}"
                               class="nav-link-item text-sm tracking-wide px-3 py-2 rounded-lg
                                {{ request()->routeIs('user.books') ? 'active-bg' : '' }}">
                                Kategori
                            </a>

                            <a href="#" class="nav-link-item text-sm tracking-wide px-3 py-2 rounded-lg">
                                Peminjaman
                            </a>

                            <a href="{{ route('user.profile.index') }}"
                                class="nav-link-item text-sm px-3 py-2 rounded-lg
                                {{ request()->routeIs('user.profile.*') ? 'active-bg' : '' }}">
                                Profile
                            </a>
                        @endif
                    @endauth
                </div>

                <!-- MOBILE MENU BUTTON -->
                <button class="md:hidden text-xl" id="mobileMenuBtn" style="color: var(--color-primary-dark);">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <!-- MOBILE NAV -->
            <div id="mobileMenu" class="hidden md:hidden mt-4 pb-4 border-t-2 pt-4"
                style="border-color: var(--color-primary);">
                <div class="flex flex-col gap-3">

                    @auth
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="py-2 px-3 text-sm"
                                style="color: var(--color-primary-dark);">
                                Dashboard
                            </a>

                            <a href="{{ route('admin.borrows.pending') }}" class="py-2 px-3 text-sm"
                                style="color: var(--color-primary-dark);">
                                Pending Request
                            </a>


                            <a href="{{ route('admin.users.index') }}" class="py-2 px-3 text-sm"
                                style="color: var(--color-primary-dark);">
                                Kelola User
                            </a>

                            <a href="{{ route('admin.books.index') }}" class="py-2 px-3 text-sm"
                                style="color: var(--color-primary-dark);">
                                Kelola Buku
                            </a>

                            <a href="{{ route('admin.categories.index') }}" class="py-2 px-3 text-sm"
                                style="color: var(--color-primary-dark);">
                                Kelola Kategori
                            </a>

                            <a href="{{ route('logout') }}" class="py-2 px-3 text-sm text-white rounded-lg"
                                style="background: var(--color-primary-dark); box-shadow: 0 10px 25px rgba(6, 182, 212, 0.2);">
                                Logout
                            </a>
                        @elseif(Auth::user()->role === 'pengguna')
                            <a href="{{ route('user.dashboard') }}" class="py-2 px-3 text-sm"
                                style="color: var(--color-primary-dark);">
                                Dashboard
                            </a>

                            <a href="{{ route('user.books') }}" class="py-2 px-3 rounded-lg text-sm
                               {{ request()->routeIs('user.books') ? 'active-bg' : '' }}">
                                Kategori
                            </a>

                            <a href="#" class="py-2 px-3 text-sm" style="color: var(--color-primary-dark);">
                                Peminjaman</a>

                            <a href="{{ route('user.profile.index') }}" class="py-2 px-3 text-sm"
                                style="color: var(--color-primary-dark);">
                                Profile
                            </a>
                        @endif
                    @endauth

                </div>
            </div>
        </nav>
    </header>

    <main class="mx-auto min-h-screen">
        @yield('content')
    </main>

    <footer class="border-t-2">
        <div class="container mx-auto px-4 text-center py-6 text-sm font-semibold">
            © {{ date('Y') }} Litera — All Rights Reserved.
        </div>
    </footer>

    <script>
        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        });
    </script>

</body>

</html>
