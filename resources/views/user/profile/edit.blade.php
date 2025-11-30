@extends('layouts.app')

@section('content')
    <div class="min-h-screen" style="background-color: #FFFFFF;">

        <!-- Header -->
        <div class="border-b" style="border-color: #06B6D4; background-color: #F0F9FF;">
            <div class="max-w-4xl mx-auto px-6 py-8 lg:px-8">
                <a href="{{ route('user.profile.index') }}" class="inline-block mb-4 text-sm font-semibold transition-all"
                    style="color: #0891B2;">
                    ← Kembali
                </a>
                <h1 class="text-4xl font-black" style="color: #1E1B4B;">Edit Profil</h1>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-6 py-12 lg:px-8">

            <!-- Card -->
            <div class="rounded-xl p-12 transition-all"
                style="background-color: #FFFFFF; border: 2px solid #06B6D4; box-shadow: 0 8px 24px rgba(6, 182, 212, 0.15);">

                <!-- Notifications -->
                @if (session('success'))
                    <div class="mb-6 p-4 rounded-lg font-semibold text-white"
                        style="background: linear-gradient(135deg, #06B6D4, #0891B2);">
                        ✓ {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 p-4 rounded-lg font-semibold text-white"
                        style="background: linear-gradient(135deg, #EF4444, #DC2626);">
                        ✕ {{ session('error') }}
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('user.profile.update') }}" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-xs font-semibold mb-3"
                            style="color: #0891B2; letter-spacing: .5px;">
                            NAMA LENGKAP
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                            class="w-full px-4 py-3 rounded-lg border-2 transition-all focus:outline-none focus:ring-2"
                            style="border-color: #06B6D4; background-color: #F0F9FF; color: #1E1B4B;"
                            @error('name') style="border-color: #EF4444;" @enderror>
                        @error('name')
                            <p class="mt-2 text-sm" style="color: #EF4444;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-xs font-semibold mb-3"
                            style="color: #0891B2; letter-spacing: .5px;">
                            EMAIL
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                            required
                            class="w-full px-4 py-3 rounded-lg border-2 transition-all focus:outline-none focus:ring-2"
                            style="border-color: #06B6D4; background-color: #F0F9FF; color: #1E1B4B;"
                            @error('email') style="border-color: #EF4444;" @enderror>
                        @error('email')
                            <p class="mt-2 text-sm" style="color: #EF4444;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-4 pt-6" style="border-top: 2px solid #06B6D4;">

                        <!-- Save -->
                        <button type="submit"
                            class="flex-1 py-4 font-bold rounded-lg transition-all shadow-md hover:shadow-xl text-white"
                            style="background: linear-gradient(135deg, #0891B2, #06B6D4);">
                            Simpan Perubahan
                        </button>

                        <!-- Cancel -->
                        <a href="{{ route('user.profile.index') }}"
                            class="flex-1 py-4 font-bold text-center rounded-lg border-2 transition-all"
                            style="border-color: #1E1B4B; color: #1E1B4B;">
                            Batal
                        </a>

                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
