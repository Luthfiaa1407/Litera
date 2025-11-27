@extends('layouts.app')

@section('content')
<div class="min-h-screen" style="background-color: #FDFCF7;">
    <!-- Header -->
    <div class="border-b" style="border-color: #D9D7CB; background-color: #FDFCF7;">
        <div class="max-w-4xl mx-auto px-6 py-8 lg:px-8">
            <a href="{{ route('user.profile.index') }}" class="inline-block mb-4 text-sm font-semibold" style="color: #C8C5BC;">
                ← Kembali
            </a>
            <h1 class="text-4xl font-black" style="color: #1a1a1a;">Edit Profil</h1>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-6 py-12 lg:px-8">
        <!-- Edit Form Card -->
        <div style="background-color: #FDFCF7; border: 2px solid #D9D7CB;" class="rounded-lg p-12">
            
            <!-- Notifications -->
            @if(session('success'))
            <div class="mb-6 p-4 rounded-lg" style="background-color: #D9D7CB; color: #1a1a1a;">
                <p class="font-semibold">✓ {{ session('success') }}</p>
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 p-4 rounded-lg" style="background-color: #D9D7CB; color: #1a1a1a;">
                <p class="font-semibold">✕ {{ session('error') }}</p>
            </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('user.profile.update') }}" class="space-y-8">
                @csrf
                @method('PUT')
                
                <!-- Full Name Field -->
                <div>
                    <label for="name" class="block text-xs font-semibold mb-3" style="color: #C8C5BC;">
                        NAMA LENGKAP
                    </label>
                    <input type="text" id="name" name="name" 
                           value="{{ old('name', $user->name) }}" 
                           required
                           class="w-full px-4 py-3 rounded-lg border-2 transition-all focus:outline-none"
                           style="border-color: #D9D7CB; background-color: #FDFCF7; color: #1a1a1a;"
                           @error('name') style="border-color: #ff6b6b;" @enderror>
                    @error('name')
                    <p class="mt-2 text-sm" style="color: #ff6b6b;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-xs font-semibold mb-3" style="color: #C8C5BC;">
                        EMAIL
                    </label>
                    <input type="email" id="email" name="email" 
                           value="{{ old('email', $user->email) }}" 
                           required
                           class="w-full px-4 py-3 rounded-lg border-2 transition-all focus:outline-none"
                           style="border-color: #D9D7CB; background-color: #FDFCF7; color: #1a1a1a;"
                           @error('email') style="border-color: #ff6b6b;" @enderror>
                    @error('email')
                    <p class="mt-2 text-sm" style="color: #ff6b6b;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex gap-4 pt-6" style="border-top: 2px solid #D9D7CB;">
                    <button type="submit" class="flex-1 py-4 font-bold rounded-lg transition-all"
                            style="background-color: #C8C5BC; color: #FDFCF7;">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('user.profile.index') }}" class="flex-1 py-4 font-bold text-center rounded-lg border-2 transition-all"
                       style="border-color: #C8C5BC; color: #C8C5BC;">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
