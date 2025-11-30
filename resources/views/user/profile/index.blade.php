@extends('layouts.app')

@section('content')
    <div class="min-h-screen" style="background-color: #FFFFFF;">

        <!-- Header -->
        <div class="border-b" style="border-color: #06B6D4; background-color: #F0F9FF;">
            <div class="max-w-4xl mx-auto px-6 py-8 lg:px-8">
                <a href="{{ route('user.dashboard') }}" class="inline-block mb-4 text-sm font-semibold"
                    style="color: #0891B2;">
                    ← Kembali
                </a>
                <h1 class="text-4xl font-black" style="color: #1E1B4B;">Profil Anda</h1>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-6 py-12 lg:px-8">

            <!-- Profile Card -->
            <div class="rounded-xl p-12 mb-8 shadow-lg"
                style="background-color: #FFFFFF; border: 2px solid #06B6D4; box-shadow: 0 8px 24px rgba(6, 182, 212, 0.15);">

                <!-- Avatar -->
                <div class="text-center mb-12 pb-12" style="border-bottom: 2px solid #06B6D4;">
                    <div class="inline-flex items-center justify-center w-28 h-28 rounded-full mb-6 shadow-md"
                        style="background: linear-gradient(135deg, #0891B2, #06B6D4); color: #FFFFFF;">
                        <svg class="w-14 h-14" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                        </svg>
                    </div>

                    <h2 class="text-3xl font-black mb-2" style="color: #1E1B4B;">{{ $user->name }}</h2>
                    <p style="color: #475569;">{{ $user->email }}</p>

                    <div class="inline-block px-4 py-2 text-xs font-semibold rounded-full mt-4 shadow-sm text-white"
                        style="background: linear-gradient(135deg, #1E1B4B, #0891B2);">
                        {{ $user->role === 'admin' ? 'Administrator' : 'Pengguna' }}
                    </div>
                </div>

                <!-- Account Information -->
                <div class="mb-12">
                    <h3 class="text-xl font-black mb-8" style="color: #1E1B4B;">Informasi Akun</h3>

                    <div class="space-y-6">
                        <div class="pb-6" style="border-bottom: 1px solid #E0F2FE;">
                            <p class="text-xs font-semibold mb-2" style="color: #0891B2; letter-spacing: 0.5px;">NAMA
                                LENGKAP</p>
                            <p style="color: #1E1B4B;">{{ $user->name }}</p>
                        </div>

                        <div class="pb-6" style="border-bottom: 1px solid #E0F2FE;">
                            <p class="text-xs font-semibold mb-2" style="color: #0891B2; letter-spacing: 0.5px;">EMAIL</p>
                            <p style="color: #1E1B4B;">{{ $user->email }}</p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold mb-2" style="color: #0891B2; letter-spacing: 0.5px;">BERGABUNG
                                SEJAK</p>
                            <p style="color: #1E1B4B;">{{ $user->created_at->format('d F Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Statistics -->
                <div class="mb-12 pb-12" style="border-bottom: 2px solid #06B6D4;">
                    <h3 class="text-xl font-black mb-8" style="color: #1E1B4B;">Statistik Peminjaman</h3>

                    <div class="grid grid-cols-3 gap-4">

                        <!-- Total -->
                        <div class="text-center p-6 rounded-lg shadow-md text-white"
                            style="background: linear-gradient(135deg, #0891B2, #06B6D4);">
                            <p class="text-3xl font-black mb-2">{{ $total_peminjaman ?? 0 }}</p>
                            <p class="text-xs font-semibold">Total</p>
                        </div>

                        <!-- Aktif -->
                        <div class="text-center p-6 rounded-lg shadow-md text-white"
                            style="background: linear-gradient(135deg, #0891B2, #06B6D4);">
                            <p class="text-3xl font-black mb-2">{{ $peminjaman_aktif ?? 0 }}</p>
                            <p class="text-xs font-semibold">Aktif</p>
                        </div>

                        <!-- Riwayat -->
                        <div class="text-center p-6 rounded-lg shadow-md text-white"
                            style="background: linear-gradient(135deg, #06B6D4, #0891B2);">
                            <p class="text-3xl font-black mb-2">{{ $riwayat_peminjaman ?? 0 }}</p>
                            <p class="text-xs font-semibold">Riwayat</p>
                        </div>

                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4">
                    <a href="{{ route('user.profile.edit') }}"
                        class="flex-1 py-4 font-bold text-center rounded-lg transition-all shadow-md text-white"
                        style="background: linear-gradient(135deg, #0891B2, #06B6D4);">
                        Edit Profil
                    </a>

                    <a href="{{ route('logout') }}" onclick="return confirm('Apakah Anda yakin ingin logout?')"
                        class="flex-1 py-4 font-bold text-center rounded-lg border-2 transition-all"
                        style="border-color: #1E1B4B; color: #1E1B4B;">
                        Logout
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection
