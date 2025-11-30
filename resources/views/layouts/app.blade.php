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
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <style>
        * {
            font-family: "Poppins", sans-serif;

        }

        :root {
            --color-primary: #C8C5BC;
            --color-secondary: #D9D7CB;
            --color-bg: #FDFCF7;
            --color-text: #333333;
        }

        body {
            background-color: var(--color-bg);
            color: var(--color-text);
        }

        .nav-link-item {
            transition: .3s ease;
        }

        .nav-link-item:hover {
            transform: translateY(-2px);
            color: var(--color-primary) !important;
        }

        /* ACTIVE HIGHLIGHT */
        .active-bg {
            background-color: var(--color-secondary) !important;
            font-weight: 600 !important;
            border-radius: 10px;
            padding: 8px 12px !important;
        }
    </style>
</head>

<body>

    <header class="border-b-2 border-opacity-30"
        style="background-color: var(--color-bg); border-color: var(--color-primary);">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">

                <!-- Brand -->
                <div class="text-2xl font-bold">
                    <i class="fas fa-book mr-2"></i>Litera
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

                            <a href="#" class="nav-link-item text-sm tracking-wide px-3 py-2 rounded-lg">
                                Pending Request
                            </a>

                            <a href="{{ route('admin.users.index') }}"
                                class="nav-link-item text-sm tracking-wide px-3 py-2 rounded-lg
                                {{ request()->routeIs('admin.users.*') ? 'active-bg' : '' }}">
                                Kelola User
                            </a>

                            <a href="{{ route('admin.books.index') }}"
                                class="nav-link-item text-sm tracking-wide px-3 py-2 rounded-lg
                                {{ request()->routeIs('admin.books.*') ? 'active-bg' : '' }}">
                                Kelola Buku
                            </a>

                            <a href="{{ route('logout') }}" class="nav-link-item text-sm tracking-wide px-4 py-2 rounded-lg"
                                style="background-color: var(--color-primary);">
                                Logout
                            </a>
                        @elseif(Auth::user()->role === 'pengguna')
                            <a href="{{ route('user.dashboard') }}"
                                class="nav-link-item text-sm tracking-wide px-3 py-2 rounded-lg
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
                                class="nav-link-item text-sm tracking-wide px-3 py-2 rounded-lg
                                {{ request()->routeIs('user.profile.*') ? 'active-bg' : '' }}">
                                Profile
                            </a>
                        @endif
                    @endauth
                </div>

                <!-- MOBILE MENU BUTTON -->
                <button class="md:hidden text-xl" id="mobileMenuBtn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <!-- MOBILE NAV -->
            <div id="mobileMenu" class="hidden md:hidden mt-4 pb-4 border-t-2 pt-4"
                style="border-color: var(--color-secondary);">
                <div class="flex flex-col gap-3">

                    @auth
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}"
                                class="py-2 px-3 rounded-lg text-sm
                                {{ request()->routeIs('admin.dashboard') ? 'active-bg' : '' }}">
                                Dashboard
                            </a>

                            <a href="#" class="py-2 px-3 rounded-lg text-sm">
                                Pending Request
                            </a>

                            <a href="{{ route('admin.users.index') }}"
                                class="py-2 px-3 rounded-lg text-sm
                                {{ request()->routeIs('admin.users.*') ? 'active-bg' : '' }}">
                                Kelola User
                            </a>

                            <a href="{{ route('admin.books.index') }}"
                                class="py-2 px-3 rounded-lg text-sm
                                {{ request()->routeIs('admin.books.*') ? 'active-bg' : '' }}">
                                Kelola Buku
                            </a>

                            <a href="{{ route('logout') }}" class="py-2 px-3 rounded-lg text-sm"
                                style="background-color: var(--color-primary);">
                                Logout
                            </a>
                        @elseif(Auth::user()->role === 'pengguna')
                            <a href="{{ route('user.dashboard') }}"
                                class="py-2 px-3 rounded-lg text-sm
                                {{ request()->routeIs('user.dashboard') ? 'active-bg' : '' }}">
                                Dashboard
                            </a>

                            <a href="{{ route('user.books') }}" class="py-2 px-3 rounded-lg text-sm
                               {{ request()->routeIs('user.books') ? 'active-bg' : '' }}">
                                Kategori
                            </a>

                            <a href="#" class="py-2 px-3 rounded-lg text-sm">
                                Peminjaman
                            </a>

                            <a href="{{ route('user.profile.index') }}"
                                class="py-2 px-3 rounded-lg text-sm
                                {{ request()->routeIs('user.profile.*') ? 'active-bg' : '' }}">
                                Profile
                            </a>
                        @endif
                    @endauth

                </div>
            </div>
        </nav>
    </header>

    <main class="container mx-auto px-4 py-8 min-h-screen">
        @yield('content')
    </main>

    <footer class="border-t-2 mt-12" style="border-color: var(--color-primary);">
        <div class="container mx-auto px-4 text-center py-6">
            <p class="font-semibold text-sm">
                © {{ date('Y') }} Litera — All Rights Reserved.
            </p>
        </div>
    </footer>

    <script>
        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        });
    </script>

</body>

</html>
