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

    {{-- HEADER --}}
    <header class="glass-header">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="text-3xl font-bold flex items-center gap-2" style="color: var(--color-primary-dark);">
                    <i class="fas fa-book"></i> Litera
                </div>

                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link-item text-sm
                        {{ request()->routeIs('admin.dashboard') ? 'active-bg' : '' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('admin.borrows.pending') }}"
                        class="nav-link-item text-sm
                        {{ request()->routeIs('admin.borrows.*') ? 'active-bg' : '' }}">
                        Pending Request
                    </a>

                    <a href="{{ route('admin.users.index') }}"
                        class="nav-link-item text-sm
                        {{ request()->routeIs('admin.users.*') ? 'active-bg' : '' }}">
                        Kelola User
                    </a>

                    <a href="{{ route('admin.books.index') }}"
                        class="nav-link-item text-sm
                        {{ request()->routeIs('admin.books.*') ? 'active-bg' : '' }}">
                        Kelola Buku
                    </a>

                    <a href="{{ route('logout') }}"
                        class="text-sm tracking-wide px-4 py-2 rounded-lg text-white"
                        style="background: var(--color-primary-dark);">
                        Logout
                    </a>
                </div>

                <button class="md:hidden text-xl" id="mobileMenuBtn" style="color: var(--color-primary-dark);">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <div id="mobileMenu" class="hidden md:hidden mt-4 pb-4 border-t-2 pt-4"
                style="border-color: var(--color-primary);">
                <div class="flex flex-col gap-3">

                    <a href="{{ route('admin.dashboard') }}" class="py-2 px-3 text-sm">
                        Dashboard
                    </a>

                    <a href="{{ route('admin.borrows.pending') }}" class="py-2 px-3 text-sm">
                        Pending Request
                    </a>

                    <a href="{{ route('admin.users.index') }}" class="py-2 px-3 text-sm">
                        Kelola User
                    </a>

                    <a href="{{ route('admin.books.index') }}" class="py-2 px-3 text-sm">
                        Kelola Buku
                    </a>

                    <a href="{{ route('logout') }}"
                        class="py-2 px-3 text-sm text-white rounded-lg"
                        style="background: var(--color-primary-dark);">
                        Logout
                    </a>
                </div>
            </div>
        </nav>
    </header>

    {{-- MAIN CONTENT --}}
    <main class="container mx-auto min-h-screen px-4 py-10">
      
    </main>

    {{-- FOOTER --}}
    <footer>
        <div class="container mx-auto px-4 text-center py-6 text-sm font-semibold">
            © {{ date('Y') }} Litera Admin — All Rights Reserved.
        </div>
    </footer>

    <script>
        document.getElementById('mobileMenuBtn').addEventListener('click', function () {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        });
    </script>

</body>

</html>
