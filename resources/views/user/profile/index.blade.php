@extends('layouts.app')

@section('content')
    <div class="min-h-screen" style="background-color: #FDFCF7;">
        <!-- Header -->
        <div class="border-b" style="border-color: #D9D7CB; background-color: #FDFCF7;">
            <div class="max-w-4xl mx-auto px-6 py-8 lg:px-8">
                <a href="{{ route('user.dashboard') }}" class="inline-block mb-4 text-sm font-semibold" style="color: #C8C5BC;">
                    ← Kembali
                </a>
                <h1 class="text-4xl font-black" style="color: #1a1a1a;">Profil Anda</h1>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-6 py-12 lg:px-8">
            <!-- Profile Card -->
            <div style="background-color: #FDFCF7; border: 2px solid #D9D7CB;" class="rounded-lg p-12 mb-8">
                <!-- Avatar Section -->
                <div class="text-center mb-12 pb-12" style="border-bottom: 2px solid #D9D7CB;">
                    <div class="inline-flex items-center justify-center w-24 h-24 rounded-full mb-6"
                        style="background-color: #D9D7CB; color: #1a1a1a;">
                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                        </svg>
                    </div>
                    <h2 class="text-3xl font-black mb-2" style="color: #1a1a1a;">{{ $user->name }}</h2>
                    <p style="color: #999;">{{ $user->email }}</p>
                    <div class="inline-block px-4 py-2 text-xs font-semibold rounded-full mt-4"
                        style="background-color: #D9D7CB; color: #1a1a1a;">
                        {{ $user->role === 'admin' ? 'Administrator' : 'Pengguna' }}
                    </div>
                </div>

                <!-- Information Section -->
                <div class="mb-12">
                    <h3 class="text-xl font-black mb-8" style="color: #1a1a1a;">Informasi Akun</h3>

                    <div class="space-y-6">
                        <div class="pb-6" style="border-bottom: 1px solid #D9D7CB;">
                            <p class="text-xs font-semibold mb-2" style="color: #C8C5BC;">NAMA LENGKAP</p>
                            <p style="color: #1a1a1a;">{{ $user->name }}</p>
                        </div>

                        <div class="pb-6" style="border-bottom: 1px solid #D9D7CB;">
                            <p class="text-xs font-semibold mb-2" style="color: #C8C5BC;">EMAIL</p>
                            <p style="color: #1a1a1a;">{{ $user->email }}</p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold mb-2" style="color: #C8C5BC;">BERGABUNG SEJAK</p>
                            <p style="color: #1a1a1a;">{{ $user->created_at->format('d F Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Statistics Section -->
                <div class="mb-12 pb-12" style="border-bottom: 2px solid #D9D7CB;">
                    <h3 class="text-xl font-black mb-8" style="color: #1a1a1a;">Statistik Peminjaman</h3>

                    <div class="grid grid-cols-3 gap-4">
                        <div class="text-center p-6" style="background-color: #D9D7CB; border-radius: 8px;">
                            <p class="text-3xl font-black mb-2" style="color: #1a1a1a;">{{ $total_peminjaman ?? 0 }}</p>
                            <p class="text-xs font-semibold" style="color: #999;">Total Peminjaman</p>
                        </div>
                        <div class="text-center p-6" style="background-color: #D9D7CB; border-radius: 8px;">
                            <p class="text-3xl font-black mb-2" style="color: #1a1a1a;">{{ $peminjaman_aktif ?? 0 }}</p>
                            <p class="text-xs font-semibold" style="color: #999;">Peminjaman Aktif</p>
                        </div>
                        <div class="text-center p-6" style="background-color: #D9D7CB; border-radius: 8px;">
                            <p class="text-3xl font-black mb-2" style="color: #1a1a1a;">{{ $riwayat_peminjaman ?? 0 }}</p>
                            <p class="text-xs font-semibold" style="color: #999;">Riwayat Peminjaman</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4">
                    <a href="{{ route('user.profile.edit') }}"
                        class="flex-1 py-4 font-bold text-center rounded-lg transition-all"
                        style="background-color: #C8C5BC; color: #FDFCF7;">
                        Edit Profil
                    </a>
                    <a href="{{ route('logout') }}" onclick="return confirm('Apakah Anda yakin ingin logout?')"
                        class="flex-1 py-4 font-bold text-center rounded-lg border-2 transition-all"
                        style="border-color: #C8C5BC; color: #C8C5BC;">
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
