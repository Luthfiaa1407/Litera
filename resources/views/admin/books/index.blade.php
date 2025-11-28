@extends('layouts.app')

@section('content')
    <div class="mt-8 max-w-6xl mx-auto px-4">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold flex items-center gap-2 text-[#0891B2]">
                <i class="fas fa-book"></i>
                Kelola Buku
            </h1>

            <a href="{{ route('admin.books.create') }}"
                class="px-4 py-2 rounded-md shadow bg-[#0891B2] text-white hover:bg-[#06B6D4] transition">
                <i class="fas fa-plus me-1"></i>Tambah Buku
            </a>
        </div>

        <!-- Success -->
        @if (session('success'))
            <div id="successAlert"
                class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow flex justify-between">
                <span><i class="fas fa-check-circle mr-2"></i>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-green-700 font-bold">×</button>
            </div>
        @endif

        <!-- Error -->
        @if (session('error'))
            <div id="errorAlert"
                class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow flex justify-between">
                <span><i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}</span>
                <button onclick="this.parentElement.remove()" class="text-red-700 font-bold">×</button>
            </div>
        @endif

        <!-- Card -->
        <div class="bg-white rounded-xl shadow p-6">

            @if ($books->count() > 0)
                <div class="overflow-x-auto">

                    <table class="min-w-full text-left border-collapse">

                        <thead>
                            <tr class="bg-[#06B6D4]/10">
                                <th class="px-5 py-3 font-semibold text-[#0891B2]">#</th>
                                <th class="px-5 py-3 font-semibold text-[#0891B2]">Cover</th>
                                <th class="px-5 py-3 font-semibold text-[#0891B2]">Judul</th>
                                <th class="px-5 py-3 font-semibold text-[#0891B2]">Penulis</th>
                                <th class="px-5 py-3 font-semibold text-[#0891B2]">Kategori</th>
                                <th class="px-5 py-3 font-semibold text-[#0891B2]">Tahun</th>
                                <th class="px-5 py-3 font-semibold text-[#0891B2]">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">

                            @foreach ($books as $i => $book)
                                <tr class="hover:bg-gray-50 transition">

                                    <td class="px-5 py-4">{{ $i + $books->firstItem() }}</td>

                                    <td class="px-5 py-4">
                                        @if ($book->cover)
                                            <img src="{{ asset('storage/' . $book->cover) }}"
                                                class="w-14 h-20 object-cover rounded-md shadow" />
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>

                                    <td class="px-5 py-4 font-semibold text-gray-800">{{ $book->title }}</td>
                                    <td class="px-5 py-4">{{ $book->author }}</td>
                                    <td class="px-5 py-4">{{ $book->category->name }}</td>
                                    <td class="px-5 py-4">{{ $book->year }}</td>

                                    <td class="px-5 py-4">
                                        <div class="flex gap-2">

                                            <!-- Edit -->
                                            <a href="{{ route('admin.books.edit', $book->id) }}"
                                                class="px-3 py-1.5 border border-[#0891B2] text-[#0891B2] rounded-md hover:bg-[#0891B2] hover:text-white transition">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- Delete → Modal -->
                                            <button onclick="openDeleteModal({{ $book->id }})"
                                                class="px-3 py-1.5 border border-red-500 text-red-500 rounded-md hover:bg-red-500 hover:text-white transition">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal Delete -->
                                <div id="modalDelete-{{ $book->id }}"
                                    class="fixed inset-0 bg-black/50 flex items-center justify-center hidden animate-modal z-50">

                                    <div class="bg-white p-6 rounded-lg shadow-xl w-80 text-center">
                                        <h2 class="text-lg font-semibold text-gray-800 mb-3">Hapus Buku?</h2>

                                        <p class="text-gray-600 mb-5">
                                            Apakah Anda yakin ingin menghapus buku
                                            <b>{{ $book->title }}</b>?
                                        </p>

                                        <div class="flex justify-center gap-3">

                                            <button onclick="closeDeleteModal({{ $book->id }})"
                                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                                                Batal
                                            </button>

                                            <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST">
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

                <div class="mt-6">{{ $books->links() }}</div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-book text-gray-400 text-6xl mb-4"></i>
                    <h3 class="text-gray-500 text-xl font-medium">Belum ada buku terdaftar</h3>
                    <p class="text-gray-400 mb-5">Mulai dengan menambahkan buku baru.</p>

                    <a href="{{ route('admin.books.create') }}"
                        class="px-5 py-2.5 bg-[#0891B2] text-white rounded-md shadow hover:bg-[#06B6D4] transition">
                        <i class="fas fa-plus mr-1"></i>Tambah Buku
                    </a>
                </div>
            @endif

        </div>
    </div>

        @keyframes modalPop {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
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

    @if (session('success') || session('error'))
        <script>
            setTimeout(() => {
                ["successAlert", "errorAlert"].forEach(id => {
                    const el = document.getElementById(id);
                    if (el) {
                        el.style.opacity = "0";
                        setTimeout(() => el.remove(), 500);
                    }
                });
            }, 5000);
        </script>
    @endif
@endsection
