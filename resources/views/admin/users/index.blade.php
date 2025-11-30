@extends('layouts.app')

@section('content')
    <div class="mt-8 max-w-6xl mx-auto px-4">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold flex items-center gap-2 text-[#0891B2]">
                <i class="fas fa-users"></i>
                Kelola Pengguna
            </h1>

            <a href="{{ route('admin.users.create') }}"
                class="px-4 py-2 rounded-md shadow bg-[#0891B2] text-white hover:bg-[#06B6D4] transition">
                <i class="fas fa-plus me-1"></i>Tambah User
            </a>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div id="successAlert"
                class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow flex justify-between">
                <span><i class="fas fa-check-circle mr-2"></i>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-green-700 font-bold">×</button>
            </div>
        @endif

        <!-- Error Message -->
        @if (session('error'))
            <div id="errorAlert"
                class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow flex justify-between">
                <span><i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}</span>
                <button onclick="this.parentElement.remove()" class="text-red-700 font-bold">×</button>
            </div>
        @endif

        <!-- Card -->
        <div class="bg-white rounded-xl shadow p-6">
            @if ($users->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left border-collapse">

                        <thead>
                            <tr class="bg-[#06B6D4]/10">
                                <th class="px-5 py-3 font-semibold text-[#0891B2]">#</th>
                                <th class="px-5 py-3 font-semibold text-[#0891B2]">Nama</th>
                                <th class="px-5 py-3 font-semibold text-[#0891B2]">Email</th>
                                <th class="px-5 py-3 font-semibold text-[#0891B2]">Role</th>
                                <th class="px-5 py-3 font-semibold text-[#0891B2]">Tanggal Dibuat</th>
                                <th class="px-5 py-3 font-semibold text-[#0891B2]">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">

                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-50 transition">

                                    <td class="px-5 py-4">{{ $loop->iteration }}</td>

                                    <!-- Nama -->
                                    <td class="px-5 py-4">
                                        <div class="flex items-center gap-3">

                                            <div
                                                class="w-10 h-10 rounded-full bg-[#0891B2] text-white flex items-center justify-center">
                                                <i class="fas fa-user"></i>
                                            </div>

                                            <div>
                                                <span class="font-semibold">{{ $user->name }}</span>
                                                @if ($user->id == Auth::id())
                                                    <span class="ml-2 text-xs bg-[#06B6D4] text-white px-2 py-0.5 rounded">
                                                        Anda
                                                    </span>
                                                @endif
                                            </div>

                                        </div>
                                    </td>

                                    <td class="px-5 py-4">{{ $user->email }}</td>

                                    <td class="px-5 py-4 capitalize text-gray-700">
                                        {{ $user->role }}
                                    </td>

                                    <td class="px-5 py-4">
                                        {{ $user->created_at->format('d/m/Y H:i') }}
                                    </td>

                                    <!-- Aksi -->
                                    <td class="px-5 py-4">
                                        <div class="flex gap-2">

                                            <!-- Edit -->
                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                                class="px-3 py-1.5 border border-[#0891B2] text-[#0891B2] rounded-md hover:bg-[#0891B2] hover:text-white transition">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- Delete -->
                                            @if ($user->id != Auth::id())
                                                <button onclick="openDeleteModal('{{ $user->id }}')"
                                                    class="px-3 py-1.5 border border-red-500 text-red-500 rounded-md hover:bg-red-500 hover:text-white transition">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @else
                                                <button
                                                    class="px-3 py-1.5 border border-gray-400 text-gray-400 rounded-md cursor-not-allowed">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif

                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal Hapus -->
                                <div id="modalDelete-{{ $user->id }}"
                                    class="fixed inset-0 bg-black/40 hidden flex items-center justify-center z-50">

                                    <!-- Modal Box -->
                                    <div class="bg-white w-full max-w-md rounded-2xl shadow-xl p-6 animate-fade">

                                        <!-- Header -->
                                        <div class="flex items-center gap-2 text-red-600 mb-4">
                                            <i class="fa-solid fa-circle-exclamation text-xl"></i>
                                            <h2 class="text-xl font-semibold">Konfirmasi Hapus</h2>
                                        </div>

                                        <p class="text-gray-700 mb-4">
                                            Apakah Anda yakin ingin menghapus user ini?
                                        </p>

                                        <!-- User Detail Box -->
                                        <div class="bg-red-50 border border-red-200 px-4 py-3 rounded-lg mb-4">
                                            <p><strong>Nama:</strong> {{ $user->name }}</p>
                                            <p><strong>Email:</strong> {{ $user->email }}</p>
                                            <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
                                        </div>

                                        <!-- Warning Text -->
                                        <p class="text-red-600 text-sm mb-6 flex items-center">
                                            <i class="fa-solid fa-triangle-exclamation mr-2"></i>
                                            Tindakan ini tidak dapat dibatalkan!
                                        </p>

                                        <!-- Buttons -->
                                        <div class="flex justify-end gap-3">
                                            <button onclick="closeDeleteModal('{{ $user->id }}')"
                                                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                                                Batal
                                            </button>

                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition flex items-center gap-2">
                                                    <i class="fas fa-trash"></i>
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
            @else
                <!-- Empty -->
                <div class="text-center py-12">
                    <i class="fas fa-users text-gray-400 text-6xl mb-4"></i>
                    <h3 class="text-gray-500 text-xl font-medium">Belum ada user terdaftar</h3>
                    <p class="text-gray-400 mb-5">Mulai dengan menambahkan user baru</p>

                    <a href="{{ route('admin.users.create') }}"
                        class="px-5 py-2.5 bg-[#0891B2] text-white rounded-md shadow hover:bg-[#06B6D4] transition">
                        <i class="fas fa-plus mr-1"></i>Tambah User Pertama
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
                transform: scale(1);
            }
        }

        .animate-modal {
            animation: modalPop .25s ease-out;
        }
    </style>

    <script>
        function openDeleteModal(id) {
            document.getElementById(`modalDelete-${id}`).classList.toggle("hidden");
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
