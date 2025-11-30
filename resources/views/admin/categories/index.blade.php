@extends('layouts.app')

@section('title', 'Kelola Kategori')

@section('content')
    <div class="mt-8 max-w-5xl mx-auto px-4">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold flex items-center gap-2 text-[#0891B2]">
                <i class="fas fa-tags"></i>
                Kelola Kategori
            </h1>

            <a href="{{ route('admin.categories.create') }}"
                class="px-4 py-2 rounded-md shadow bg-[#0891B2] text-white hover:bg-[#06B6D4] transition">
                <i class="fas fa-plus mr-1"></i>Tambah Kategori
            </a>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-xl shadow p-6">

            @if ($categories->count() > 0)

                <div class="overflow-x-auto">
                    <table class="min-w-full text-left border-collapse">

                        <thead>
                            <tr class="bg-[#06B6D4]/10">
                                <th class="px-5 py-3 font-semibold text-[#0891B2]">No</th>
                                <th class="px-5 py-3 font-semibold text-[#0891B2]">Nama Kategori</th>
                                <th class="px-5 py-3 font-semibold text-[#0891B2]">Deskripsi</th>
                                <th class="px-5 py-3 font-semibold text-[#0891B2]">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">
                            @foreach ($categories as $index => $category)
                                <tr class="hover:bg-gray-50 transition">

                                    <td class="px-5 py-4">
                                        {{ $index + $categories->firstItem() }}
                                    </td>

                                    <td class="px-5 py-4 font-semibold text-gray-800 flex items-center gap-2">
                                        <i class="fas fa-tag text-[#0891B2]"></i>
                                        {{ $category->name }}
                                    </td>

                                    <td class="px-5 py-4 text-gray-700">
                                        {{ $category->description }}
                                    </td>

                                    <td class="px-5 py-4">
                                        <div class="flex gap-2">

                                            <!-- Edit -->
                                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                class="px-3 py-1.5 border border-[#0891B2] text-[#0891B2] rounded-md hover:bg-[#0891B2] hover:text-white transition">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- Delete Button (open modal) -->
                                            <button onclick="openDeleteModal({{ $category->id }})"
                                                class="px-3 py-1.5 border border-red-500 text-red-500 rounded-md hover:bg-red-500 hover:text-white transition">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal Delete -->
                                <div id="modalDelete-{{ $category->id }}"
                                    class="fixed inset-0 bg-black/50 flex items-center justify-center hidden animate-modal z-50">

                                    <div class="bg-white p-6 rounded-lg shadow-xl w-80 text-center">
                                        <h2 class="text-lg font-semibold text-gray-800 mb-3">
                                            Hapus Kategori?
                                        </h2>

                                        <p class="text-gray-600 mb-5">
                                            Anda yakin ingin menghapus kategori
                                            <b>{{ $category->name }}</b>?
                                        </p>

                                        <div class="flex justify-center gap-3">

                                            <button onclick="closeDeleteModal({{ $category->id }})"
                                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                                                Batal
                                            </button>

                                            <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </tbody>

                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $categories->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <i class="fas fa-tags text-gray-400 text-6xl mb-4"></i>
                    <h3 class="text-gray-500 text-xl font-medium">Belum ada kategori</h3>
                    <p class="text-gray-400 mb-5">Mulai dengan menambahkan kategori baru.</p>

                    <a href="{{ route('admin.categories.create') }}"
                        class="px-5 py-2.5 bg-[#0891B2] text-white rounded-md shadow hover:bg-[#06B6D4] transition">
                        <i class="fas fa-plus mr-1"></i>Tambah Kategori
                    </a>
                </div>
            @endif

        </div>
    </div>

    <style>
        @keyframes modalPop {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
            }
        }

        .animate-modal {
            animation: modalPop .25s ease-out;
        }
    </style>

    <script>
        function openDeleteModal(id) {
            document.getElementById(`modalDelete-${id}`).classList.remove("hidden");
        }

        function closeDeleteModal(id) {
            document.getElementById(`modalDelete-${id}`).classList.add("hidden");
        }
    </script>
@endsection
