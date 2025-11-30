@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6">

        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold" style="color:#0891B2;">Tambah Kategori</h2>
            <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 rounded-md text-sm text-white" style="background:#0891B2;">Kembali</a>
        </div>

        <div class="bg-white rounded-xl shadow p-6 border-t-4" style="border-color:#06B6D4;">

            @if(session('success'))
                <div class="mb-4 p-3 rounded bg-green-50 border-l-4" style="border-color:#10B981;">
                    <p class="text-green-700">{{ session('success') }}</p>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-3 rounded bg-red-50 border-l-4" style="border-color:#EF4444;">
                    <ul class="mb-0 text-red-700">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 gap-4">
                    <x-form.input name="name" label="Nama Kategori" value="{{ old('name') }}" required />

                    <x-form.textarea name="description" label="Deskripsi" value="{{ old('description') }}" rows="4" />
                </div>

                <x-form.actions submitLabel="Simpan" cancelUrl="{{ route('admin.categories.index') }}" />

            </form>

        </div>

    </div>
@endsection
