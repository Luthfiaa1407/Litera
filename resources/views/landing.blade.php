<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Litera - Perpustakaan Digital Modern</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --color-primary: #06B6D4;
            --color-primary-dark: #0891B2;
            --color-accent: #0891B2;
            --color-bg: #FFFFFF;
            --color-light-bg: #F0F9FF;
            --color-text: #1F2937;
            --color-light-text: #475569;
        }
    </style>
</head>

<body class="font-sans antialiased" style="--color-text: #1F2937;">
    <!-- Navigation -->
    <nav class="fixed w-full top-0 z-50 shadow-lg"
        style="background: linear-gradient(to right, #06B6D4, #0891B2); color: white;">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-book-open text-2xl"></i>
                    <span class="text-2xl font-bold">Litera</span>
                </div>
                <div class="hidden md:flex space-x-4">
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 rounded-full border-2 border-white hover:bg-white transition"
                        style="color: white;">
                        <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                    </a>
                    <a href="{{ route('register') }}" class="px-4 py-2 rounded-full font-semibold transition"
                        style="background-color: white; color: #06B6D4;">
                        <i class="fas fa-user-plus mr-2"></i>Daftar
                    </a>
                </div>
                <button class="md:hidden text-2xl">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="text-white pt-32 pb-20 mt-16"
        style="background: linear-gradient(to right, #06B6D4, #0891B2);">
        <div class="container mx-auto px-6 text-center">
            <div class="mb-6">
                <i class="fas fa-book-reader text-6xl mb-4 animate-pulse"></i>
            </div>
            <h1 class="text-5xl md:text-6xl font-bold mb-6 animate-fade-in">
                Selamat Datang di Litera
            </h1>
            <p class="text-xl md:text-2xl mb-8 opacity-90 max-w-3xl mx-auto">
                <i class="fas fa-quote-left mr-2"></i>
                Perpustakaan digital terlengkap dengan koleksi buku, jurnal, dan artikel akademik yang dapat diakses
                kapan saja, di mana saja
                <i class="fas fa-quote-right ml-2"></i>
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('register') }}"
                    class="px-8 py-4 rounded-full font-bold text-lg hover:shadow-2xl hover:scale-105 transform transition"
                    style="background-color: white; color: #06B6D4;">
                    <i class="fas fa-rocket mr-2"></i>Mulai Gratis
                </a>
                <a href="#fitur"
                    class="px-8 py-4 border-2 border-white rounded-full font-bold text-lg hover:bg-white transition"
                    style="color: white;">
                    <i class="fas fa-arrow-down mr-2"></i>Pelajari Lebih Lanjut
                </a>
            </div>
            <div class="mt-12 flex flex-wrap justify-center gap-8 text-sm">
                <div class="flex items-center gap-2">
                    <i class="fas fa-check-circle text-green-300 text-xl"></i>
                    <span>Gratis untuk siswa</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fas fa-clock text-green-300 text-xl"></i>
                    <span>Akses 24/7</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fas fa-shield-alt text-green-300 text-xl"></i>
                    <span>Tanpa iklan</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="p-6">
                    <i class="fas fa-book text-5xl mb-4" style="color: #06B6D4;"></i>
                    <div class="text-4xl md:text-5xl font-bold mb-2" style="color: #06B6D4;">50K+</div>
                    <div style="color: #475569;">
                        <i class="fas fa-bookmark mr-1"></i>Buku Digital
                    </div>
                </div>
                <div class="p-6">
                    <i class="fas fa-users text-5xl mb-4" style="color: #06B6D4;"></i>
                    <div class="text-4xl md:text-5xl font-bold mb-2" style="color: #06B6D4;">100K+</div>
                    <div style="color: #475569;">
                        <i class="fas fa-user-check mr-1"></i>Pengguna Aktif
                    </div>
                </div>
                <div class="p-6">
                    <i class="fas fa-graduation-cap text-5xl mb-4" style="color: #06B6D4;"></i>
                    <div class="text-4xl md:text-5xl font-bold mb-2" style="color: #06B6D4;">5K+</div>
                    <div style="color: #475569;">
                        <i class="fas fa-file-alt mr-1"></i>Jurnal Ilmiah
                    </div>
                </div>
                <div class="p-6">
                    <i class="fas fa-globe text-5xl mb-4" style="color: #06B6D4;"></i>
                    <div class="text-4xl md:text-5xl font-bold mb-2" style="color: #06B6D4;">24/7</div>
                    <div style="color: #475569;">
                        <i class="fas fa-wifi mr-1"></i>Akses Online
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="py-20" style="background-color: #F0F9FF;">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <i class="fas fa-star text-5xl mb-4" style="color: #06B6D4;"></i>
                <h2 class="text-4xl md:text-5xl font-bold mb-4" style="color: #1F2937;">Fitur Unggulan Litera</h2>
                <p class="text-xl max-w-2xl mx-auto" style="color: #475569;">
                    <i class="fas fa-lightbulb mr-2 text-yellow-500"></i>
                    Nikmati pengalaman membaca digital yang modern dengan berbagai fitur canggih
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div
                    class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl hover:-translate-y-2 transition transform">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mb-6"
                        style="background-color: #F0F9FF;">
                        <i class="fas fa-book-reader text-3xl" style="color: #06B6D4;"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4" style="color: #1F2937;">
                        <i class="fas fa-laptop mr-2" style="color: #06B6D4;"></i>Baca Online
                    </h3>
                    <p style="color: #475569;">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        Baca buku favorit Anda langsung dari browser tanpa perlu mengunduh aplikasi tambahan
                    </p>
                </div>

                <div
                    class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl hover:-translate-y-2 transition transform">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mb-6"
                        style="background-color: #F0F9FF;">
                        <i class="fas fa-search text-3xl" style="color: #0891B2;"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4" style="color: #1F2937;">
                        <i class="fas fa-filter mr-2" style="color: #0891B2;"></i>Pencarian Cepat
                    </h3>
                    <p style="color: #475569;">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        Temukan buku yang Anda cari dengan sistem pencarian canggih dan filter kategori
                    </p>
                </div>

                <div
                    class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl hover:-translate-y-2 transition transform">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mb-6"
                        style="background-color: #F0F9FF;">
                        <i class="fas fa-bookmark text-3xl" style="color: #06B6D4;"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4" style="color: #1F2937;">
                        <i class="fas fa-heart mr-2" style="color: #06B6D4;"></i>Simpan Favorit
                    </h3>
                    <p style="color: #475569;">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        Tandai dan simpan buku favorit Anda untuk akses cepat di kemudian hari
                    </p>
                </div>

                <div
                    class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl hover:-translate-y-2 transition transform">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mb-6"
                        style="background-color: #F0F9FF;">
                        <i class="fas fa-mobile-alt text-3xl" style="color: #0891B2;"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4" style="color: #1F2937;">
                        <i class="fas fa-tablet-alt mr-2" style="color: #0891B2;"></i>Responsif
                    </h3>
                    <p style="color: #475569;">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        Akses dari perangkat apa pun - smartphone, tablet, atau komputer dengan tampilan optimal
                    </p>
                </div>

                <div
                    class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl hover:-translate-y-2 transition transform">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mb-6"
                        style="background-color: #F0F9FF;">
                        <i class="fas fa-file-pdf text-3xl" style="color: #06B6D4;"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4" style="color: #1F2937;">
                        <i class="fas fa-download mr-2" style="color: #06B6D4;"></i>Download PDF
                    </h3>
                    <p style="color: #475569;">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        Unduh buku dalam format PDF untuk dibaca secara offline kapan saja
                    </p>
                </div>

                <div
                    class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl hover:-translate-y-2 transition transform">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mb-6"
                        style="background-color: #F0F9FF;">
                        <i class="fas fa-history text-3xl" style="color: #0891B2;"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4" style="color: #1F2937;">
                        <i class="fas fa-clock mr-2" style="color: #0891B2;"></i>Riwayat Baca
                    </h3>
                    <p style="color: #475569;">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        Lacak progres membaca Anda dan lanjutkan dari halaman terakhir yang dibaca
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Collection Preview -->
    <section id="koleksi" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <i class="fas fa-layer-group text-5xl mb-4" style="color: #06B6D4;"></i>
                <h2 class="text-4xl md:text-5xl font-bold mb-4" style="color: #1F2937;">Koleksi Populer</h2>
                <p class="text-xl" style="color: #475569;">
                    <i class="fas fa-fire text-orange-500 mr-2"></i>
                    Jelajahi kategori buku yang paling diminati
                </p>
            </div>

            <div class="grid md:grid-cols-4 gap-6">
                <div class="relative group overflow-hidden rounded-xl shadow-lg cursor-pointer">
                    <div class="h-64 bg-gradient-to-br from-cyan-400 to-cyan-600 flex items-center justify-center">
                        <i class="fas fa-flask text-white text-6xl"></i>
                    </div>
                    <div
                        class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                        <div class="text-center text-white">
                            <i class="fas fa-atom text-5xl mb-3"></i>
                            <h3 class="text-2xl font-bold mb-2">Sains</h3>
                            <p><i class="fas fa-books mr-2"></i>2,500+ buku</p>
                        </div>
                    </div>
                </div>

                <div class="relative group overflow-hidden rounded-xl shadow-lg cursor-pointer">
                    <div class="h-64 bg-gradient-to-br from-cyan-300 to-cyan-500 flex items-center justify-center">
                        <i class="fas fa-palette text-white text-6xl"></i>
                    </div>
                    <div
                        class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                        <div class="text-center text-white">
                            <i class="fas fa-paint-brush text-5xl mb-3"></i>
                            <h3 class="text-2xl font-bold mb-2">Seni</h3>
                            <p><i class="fas fa-books mr-2"></i>1,800+ buku</p>
                        </div>
                    </div>
                </div>

                <div class="relative group overflow-hidden rounded-xl shadow-lg cursor-pointer">
                    <div class="h-64 bg-gradient-to-br from-teal-400 to-teal-600 flex items-center justify-center">
                        <i class="fas fa-landmark text-white text-6xl"></i>
                    </div>
                    <div
                        class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                        <div class="text-center text-white">
                            <i class="fas fa-scroll text-5xl mb-3"></i>
                            <h3 class="text-2xl font-bold mb-2">Sejarah</h3>
                            <p><i class="fas fa-books mr-2"></i>3,200+ buku</p>
                        </div>
                    </div>
                </div>

                <div class="relative group overflow-hidden rounded-xl shadow-lg cursor-pointer">
                    <div class="h-64 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                        <i class="fas fa-laptop-code text-white text-6xl"></i>
                    </div>
                    <div
                        class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                        <div class="text-center text-white">
                            <i class="fas fa-code text-5xl mb-3"></i>
                            <h3 class="text-2xl font-bold mb-2">Teknologi</h3>
                            <p><i class="fas fa-books mr-2"></i>4,100+ buku</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 text-white" style="background: linear-gradient(to right, #06B6D4, #0891B2);">
        <div class="container mx-auto px-6 text-center">
            <i class="fas fa-rocket text-6xl mb-6 animate-bounce"></i>
            <h2 class="text-4xl md:text-5xl font-bold mb-6">Siap Memulai Perjalanan Membaca Anda?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">
                <i class="fas fa-handshake mr-2"></i>
                Bergabunglah dengan ribuan pembaca lainnya dan akses koleksi lengkap perpustakaan digital kami
            </p>
            <a href="{{ route('register') }}"
                class="inline-block px-10 py-4 rounded-full font-bold text-lg hover:shadow-2xl hover:scale-105 transform transition"
                style="background-color: white; color: #06B6D4;">
                <i class="fas fa-user-plus mr-2"></i>Daftar Sekarang - GRATIS
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12" style="background-color: #1F2937; color: #D1D5DB;">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-book-open text-2xl" style="color: #06B6D4;"></i>
                        <span class="text-2xl font-bold" style="color: white;">Litera</span>
                    </div>
                    <p style="color: #9CA3AF;">
                        <i class="fas fa-quote-left mr-2"></i>
                        Perpustakaan digital modern untuk generasi masa depan
                    </p>
                </div>
                <div>
                    <h4 class="font-bold mb-4" style="color: white;">
                        <i class="fas fa-bars mr-2"></i>Menu
                    </h4>
                    <ul class="space-y-2">
                        <li><a href="#beranda" class="transition" style="color: #D1D5DB;"
                                onmouseover="this.style.color='#06B6D4'" onmouseout="this.style.color='#D1D5DB'"><i
                                    class="fas fa-home mr-2"></i>Beranda</a></li>
                        <li><a href="#fitur" class="transition" style="color: #D1D5DB;"
                                onmouseover="this.style.color='#06B6D4'" onmouseout="this.style.color='#D1D5DB'"><i
                                    class="fas fa-star mr-2"></i>Fitur</a></li>
                        <li><a href="#koleksi" class="transition" style="color: #D1D5DB;"
                                onmouseover="this.style.color='#06B6D4'" onmouseout="this.style.color='#D1D5DB'"><i
                                    class="fas fa-books mr-2"></i>Koleksi</a></li>
                        <li><a href="#tentang" class="transition" style="color: #D1D5DB;"
                                onmouseover="this.style.color='#06B6D4'" onmouseout="this.style.color='#D1D5DB'"><i
                                    class="fas fa-info-circle mr-2"></i>Tentang</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4" style="color: white;">
                        <i class="fas fa-question-circle mr-2"></i>Bantuan
                    </h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="transition" style="color: #D1D5DB;"
                                onmouseover="this.style.color='#06B6D4'" onmouseout="this.style.color='#D1D5DB'"><i
                                    class="fas fa-comment-dots mr-2"></i>FAQ</a></li>
                        <li><a href="#" class="transition" style="color: #D1D5DB;"
                                onmouseover="this.style.color='#06B6D4'" onmouseout="this.style.color='#D1D5DB'"><i
                                    class="fas fa-envelope mr-2"></i>Kontak</a></li>
                        <li><a href="#" class="transition" style="color: #D1D5DB;"
                                onmouseover="this.style.color='#06B6D4'" onmouseout="this.style.color='#D1D5DB'"><i
                                    class="fas fa-shield-alt mr-2"></i>Kebijakan Privasi</a></li>
                        <li><a href="#" class="transition" style="color: #D1D5DB;"
                                onmouseover="this.style.color='#06B6D4'" onmouseout="this.style.color='#D1D5DB'"><i
                                    class="fas fa-file-contract mr-2"></i>Syarat & Ketentuan</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4" style="color: white;">
                        <i class="fas fa-share-alt mr-2"></i>Ikuti Kami
                    </h4>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 rounded-full flex items-center justify-center transition"
                            style="background-color: #374151;" onmouseover="this.style.backgroundColor='#06B6D4'"
                            onmouseout="this.style.backgroundColor='#374151'">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full flex items-center justify-center transition"
                            style="background-color: #374151;" onmouseover="this.style.backgroundColor='#06B6D4'"
                            onmouseout="this.style.backgroundColor='#374151'">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full flex items-center justify-center transition"
                            style="background-color: #374151;" onmouseover="this.style.backgroundColor='#06B6D4'"
                            onmouseout="this.style.backgroundColor='#374151'">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t mt-8 pt-8 text-center" style="border-color: #4B5563; color: #9CA3AF;">
                <p>
                    <i class="fas fa-copyright mr-1"></i>2024 Litera. Hak Cipta Dilindungi. Dibuat dengan
                    <i class="fas fa-heart text-red-500 mx-1"></i>
                    oleh Tim Litera
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>

</html>
