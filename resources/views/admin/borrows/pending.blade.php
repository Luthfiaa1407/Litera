@extends('layouts.app')

@section('title', 'Pending Request')

@section('content')
<div class="min-h-screen bg-[#F0F9FF] px-6 py-8">
    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-cyan-700">Pending Request</h1>
            <p class="text-gray-500 text-sm mt-1">
                Daftar permintaan peminjaman yang menunggu persetujuan
            </p>
        </div>

        <!-- Alert -->
        @if (session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded-md mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($pendingBorrows->count() > 0)
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-cyan-100">

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-cyan-600 text-white text-left">
                            <tr>
                                <th class="px-4 py-3">User</th>
                                <th class="px-4 py-3">Judul Buku</th>
                                <th class="px-4 py-3">Tanggal Pinjam</th>
                                <th class="px-4 py-3">Tanggal Kembali</th>
                                <th class="px-4 py-3 text-center">Status</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($pendingBorrows as $borrow)
                                <tr class="border-b hover:bg-cyan-50 transition">
                                    <td class="px-4 py-3 font-medium text-gray-800">
                                        {{ $borrow->user->name }}
                                    </td>

                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-3">
                                            @if($borrow->book->cover)
                                                <img 
                                                    src="{{ asset('storage/'.$borrow->book->cover) }}" 
                                                    class="w-12 h-16 object-cover rounded-md shadow"
                                                >
                                            @else
                                                <div class="w-12 h-16 bg-gray-200 rounded-md flex items-center justify-center text-xs text-gray-500">
                                                    No Cover
                                                </div>
                                            @endif

                                            <span class="font-medium text-gray-700">
                                                {{ $borrow->book->title }}
                                            </span>
                                        </div>
                                    </td>

                                    <td class="px-4 py-3 text-gray-600">
                                        {{ \Carbon\Carbon::parse($borrow->borrow_date)->format('d M Y') }}
                                    </td>

                                    <td class="px-4 py-3 text-gray-600">
                                        {{ \Carbon\Carbon::parse($borrow->return_date)->format('d M Y') }}
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            Pending
                                        </span>
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        <div class="flex flex-col gap-2">
                                            <!-- Approve -->
                                            <form action="{{ route('admin.borrows.approve', $borrow->id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="bg-cyan-600 hover:bg-cyan-700 text-white text-xs font-semibold px-4 py-2 rounded-lg shadow transition w-full">
                                                    Setujui
                                                </button>
                                            </form>

                                            <!-- Reject -->
                                            <button
                                                type="button"
                                                onclick="openRejectModal({{ $borrow->id }})"
                                                class="bg-red-100 hover:bg-red-200 text-red-700 text-xs font-semibold px-4 py-2 rounded-lg transition w-full">
                                                Tolak
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        @else
            <div class="bg-white rounded-xl p-10 text-center shadow-sm border border-cyan-100">
                <i class="fas fa-inbox text-5xl text-cyan-200 mb-4"></i>
                <p class="text-gray-500">Tidak ada permintaan peminjaman.</p>
            </div>
        @endif
    </div>
</div>

<!-- Modal Reject -->
<div id="rejectModal" class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-white w-full max-w-md rounded-2xl shadow-lg p-6">
        <h3 class="text-lg font-bold text-red-600 mb-4">Tolak Peminjaman</h3>

        <form id="rejectForm" method="POST">
            @csrf

            <textarea 
                name="admin_notes" 
                required
                placeholder="Masukkan alasan penolakan..."
                class="w-full border rounded-lg px-4 py-3 focus:ring focus:ring-red-200 text-sm mb-4"
            ></textarea>

            <div class="flex justify-end gap-2">
                <button 
                    type="button"
                    onclick="closeRejectModal()"
                    class="px-4 py-2 text-sm bg-gray-100 rounded-lg"
                >
                    Batal
                </button>

                <button 
                    type="submit"
                    class="px-4 py-2 text-sm bg-red-600 text-white rounded-lg"
                >
                    Tolak
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openRejectModal(id) {
        const modal = document.getElementById('rejectModal');
        const form = document.getElementById('rejectForm');

        form.action = `/admin/borrows/${id}/reject`;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeRejectModal() {
        const modal = document.getElementById('rejectModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection
