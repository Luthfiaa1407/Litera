@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6">

        <!-- Header + Quick Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h2 class="text-2xl font-bold" style="color:#0891B2;">Dashboard Admin</h2>
                <p class="text-sm text-gray-500 mt-1">Ringkasan cepat sistem dan tindakan cepat untuk admin.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.books.create') }}" class="px-4 py-2 rounded-md text-white text-sm" style="background:#0891B2;">Tambah Buku</a>
                <a href="{{ route('admin.categories.create') }}" class="px-4 py-2 rounded-md text-white text-sm" style="background:#06B6D4;">Tambah Kategori</a>
                <a href="{{ route('admin.borrows.pending') }}" class="px-4 py-2 rounded-md border text-sm">Tinjau Pinjaman</a>
            </div>
        </div>

        <!-- Quick Stats -->
        @php
            $stats = [
                ['icon' => 'fa-hourglass-half', 'title' => 'Pending', 'value' => $pendingRequests ?? 0, 'link' => route('admin.borrows.pending')],
                ['icon' => 'fa-book-reader', 'title' => 'Dipinjam', 'value' => $activeBorrows ?? 0, 'link' => route('user.borrows.index')],
                ['icon' => 'fa-check-circle', 'title' => 'Disetujui', 'value' => $approvedRequests ?? 0, 'link' => '#'],
                ['icon' => 'fa-users', 'title' => 'Users', 'value' => $totalUsers ?? 0, 'link' => route('admin.users.index')],
                ['icon' => 'fa-book', 'title' => 'Total Buku', 'value' => $totalBooks ?? 0, 'link' => route('admin.books.index')],
            ];
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
            @foreach ($stats as $stat)
                <a href="{{ $stat['link'] }}" class="no-underline">
                    <div class="bg-white rounded-xl shadow p-4 border-t-4 hover:shadow-lg transition flex items-center gap-4" style="border-color:#06B6D4;">
                        <div class="flex-shrink-0">
                            <i class="fas {{ $stat['icon'] }} text-3xl" style="color:#0891B2;"></i>
                        </div>
                        <div>
                            <div class="text-sm font-semibold text-gray-500">{{ $stat['title'] }}</div>
                            <div class="text-2xl font-bold" style="color:#06B6D4;">{{ $stat['value'] }}</div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Pending Approvals (toggleable) -->
        <div class="mt-6">
            <div class="flex items-center justify-between bg-cyan-50 p-4 rounded-lg border-l-4" style="border-color:#06B6D4;">
                <div>
                    <h5 class="font-bold text-lg flex items-center gap-2" style="color:#0891B2;">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span id="pendingCount">{{ isset($pendingApprovals) ? $pendingApprovals->count() : 0 }}</span> permohonan pending
                    </h5>
                    <span class="text-gray-500 text-sm">Segera tinjau permohonan untuk menghindari antrian.</span>
                </div>

                <div class="flex items-center gap-3">
                    <button id="togglePending" class="px-3 py-1 rounded text-sm border">Tampilkan</button>
                    <a href="{{ route('admin.borrows.pending') }}" class="px-4 py-2 text-white rounded-md text-sm" style="background:#0891B2;">Lihat Semua</a>
                </div>
            </div>

            <div id="pendingList" class="mt-3 hidden">
                @if (isset($pendingApprovals) && $pendingApprovals->count() > 0)
                    <div class="bg-white rounded-xl shadow p-4">
                        <ul class="space-y-2">
                            @foreach($pendingApprovals as $p)
                                <li class="p-3 border rounded hover:bg-gray-50">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <div class="font-semibold">{{ $p->user->name ?? 'N/A' }}</div>
                                            <div class="text-sm text-gray-500">{{ $p->book->title ?? 'N/A' }}</div>
                                        </div>
                                        <div>
                                            <a href="#" class="px-3 py-1 rounded bg-yellow-300 text-sm">Detail</a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <div class="bg-white rounded-xl shadow p-4 text-gray-500">Tidak ada permohonan pending.</div>
                @endif
            </div>
        </div>

        <!-- Latest Activities -->
        <div class="mt-10">
            <h4 class="text-xl font-bold mb-4" style="color:#0891B2;">Aktivitas Terbaru</h4>

            <div class="bg-white shadow rounded-xl p-4">
                @if (isset($recentActivities) && $recentActivities->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead style="background:#06B6D4;" class="text-white">
                                <tr>
                                    <th class="text-left p-3">Peminjam</th>
                                    <th class="text-left p-3">Buku</th>
                                    <th class="text-left p-3">Status</th>
                                    <th class="text-left p-3">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentActivities as $activity)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="p-3">{{ $activity->user->name ?? 'N/A' }}</td>
                                        <td class="p-3">{{ $activity->book->title ?? 'N/A' }}</td>
                                        <td class="p-3">
                                            <span
                                                class="px-3 py-1 rounded-full text-white text-sm
                                    @if ($activity->status == 'pending') bg-yellow-500
                                    @elseif($activity->status == 'active') bg-blue-600
                                    @elseif($activity->status == 'approved') bg-cyan-500
                                    @elseif($activity->status == 'returned') bg-green-600
                                    @elseif($activity->status == 'rejected') bg-red-600
                                    @else bg-gray-600 @endif
                                ">
                                                {{ ucfirst($activity->status) }}
                                            </span>
                                        </td>
                                        <td class="p-3">{{ $activity->created_at->format('d M Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500">Belum ada aktivitas terbaru.</p>
                @endif
            </div>
        </div>

    </div>
@endsection
