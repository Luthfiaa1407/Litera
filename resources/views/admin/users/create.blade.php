@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-8">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold flex items-center gap-2" style="color:#0891B2;">
                <i class="fas fa-user-plus"></i>
                Tambah User Baru
            </h3>

            <a href="{{ route('admin.users.index') }}"
                class="px-4 py-2 border rounded-lg text-sm hover:bg-gray-100 transition"
                style="border-color:#0891B2; color:#0891B2;">
                <i class="fas fa-arrow-left mr-1"></i>Kembali
            </a>
        </div>

        <!-- Card -->
        <div class="bg-white shadow-md rounded-xl p-6">

            <!-- Success Message -->
            @if (session('success'))
                <div id="successAlert" class="mb-4 p-4 rounded-lg text-white flex items-center gap-2"
                    style="background: linear-gradient(135deg,#0891B2,#06B6D4);">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-semibold mb-1" style="color:#0891B2;">
                            <i class="fas fa-user mr-1"></i>Nama Lengkap
                        </label>
                        <input type="text" id="name" name="name"
                            value="{{ session('success') ? '' : old('name') }}" required
                            class="w-full p-3 border rounded-lg focus:ring-2 transition"
                            style="border-color:#06B6D4; color:#1E293B;" onfocus="this.style.borderColor='#0891B2'"
                            placeholder="Masukkan nama lengkap">

                        @error('name')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-semibold mb-1" style="color:#0891B2;">
                            <i class="fas fa-envelope mr-1"></i>Email
                        </label>
                        <input type="email" id="email" name="email"
                            value="{{ session('success') ? '' : old('email') }}" required
                            class="w-full p-3 border rounded-lg focus:ring-2 transition"
                            style="border-color:#06B6D4; color:#1E293B;" placeholder="Masukkan email">

                        @error('email')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-semibold mb-1" style="color:#0891B2;">
                            <i class="fas fa-lock mr-1"></i>Password
                        </label>
                        <input type="password" id="password" name="password" required
                            class="w-full p-3 border rounded-lg focus:ring-2 transition" style="border-color:#06B6D4;"
                            placeholder="Masukkan password">

                        @error('password')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-sm font-semibold mb-1" style="color:#0891B2;">
                            <i class="fas fa-lock mr-1"></i>Konfirmasi Password
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            class="w-full p-3 border rounded-lg focus:ring-2 transition" style="border-color:#06B6D4;"
                            placeholder="Konfirmasi password">

                        @error('password_confirmation')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Role -->
                <div class="mt-4">
                    <label class="block text-sm font-semibold mb-1" style="color:#0891B2;">
                        <i class="fas fa-user-tag mr-1"></i>Role
                    </label>
                    <select name="role" required class="w-full p-3 border rounded-lg focus:ring-2 transition"
                        style="border-color:#06B6D4; color:#1E293B;">
                        <option value="">Pilih Role</option>
                        <option value="pengguna" {{ old('role') == 'pengguna' ? 'selected' : '' }}>Pengguna</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-3 mt-6">
                    <button type="reset" class="px-4 py-2 rounded-lg border hover:bg-gray-100 transition"
                        style="border-color:#0891B2; color:#0891B2;">
                        <i class="fas fa-undo mr-1"></i>Reset
                    </button>

                    <button type="submit"
                        class="px-5 py-2 rounded-lg text-white font-medium shadow-md hover:shadow-lg transition"
                        style="background: linear-gradient(135deg,#0891B2,#06B6D4);">
                        <i class="fas fa-save mr-1"></i>Simpan User
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const alert = document.getElementById('successAlert');
                setTimeout(() => {
                    if (alert) {
                        alert.style.opacity = '0';
                        alert.style.transition = 'opacity .5s';
                        setTimeout(() => alert.remove(), 500);
                    }
                }, 5000);
            });
        </script>
    @endif
@endsection
