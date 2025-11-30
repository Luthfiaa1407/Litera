@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold" style="color:#0891B2;">Dashboard Admin</h2>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">

            @php
                $stats = [
                    ['icon' => 'fa-hourglass-half', 'title' => 'Pending', 'value' => $pendingRequests ?? 0],
                    ['icon' => 'fa-book-reader', 'title' => 'Dipinjam', 'value' => $activeBorrows ?? 0],
                    ['icon' => 'fa-check-circle', 'title' => 'Disetujui', 'value' => $approvedRequests ?? 0],
                    ['icon' => 'fa-users', 'title' => 'Users', 'value' => $totalUsers ?? 0],
                    ['icon' => 'fa-book', 'title' => 'Total Buku', 'value' => $totalBooks ?? 0],
                ];
            @endphp

            @foreach ($stats as $stat)
                <div class="bg-white rounded-xl shadow p-4 border-t-4" style="border-color:#06B6D4;">
                    <div class="text-center">
                        <i class="fas {{ $stat['icon'] }} text-3xl mb-2" style="color:#0891B2;"></i>
                        <h5 class="font-semibold text-lg" style="color:#0891B2;">{{ $stat['title'] }}</h5>
                        <p class="font-bold text-xl" style="color:#06B6D4;">{{ $stat['value'] }}</p>
                    </div>
                </div>
            @endforeach

            <!-- Kelola Kategori -->
            <a href="{{ route('admin.categories.index') }}" class="no-underline">
                <div class="bg-white rounded-xl shadow p-4 border-t-4 cursor-pointer hover:shadow-md transition"
                    style="border-color:#06B6D4;">
                    <div class="text-center">
                        <i class="fas fa-tags text-3xl mb-2" style="color:#0891B2;"></i>
                        <h5 class="font-semibold text-lg" style="color:#0891B2;">Kelola</h5>
                        <p class="font-bold text-xl" style="color:#06B6D4;">Kategori</p>
                    </div>
                </div>
            </a>

        </div>

        <!-- Pending Approvals -->
        @if (isset($pendingApprovals) && $pendingApprovals->count() > 0)
            <div class="mt-6">
                <div class="flex justify-between items-center bg-cyan-50 p-4 rounded-lg border-l-4"
                    style="border-color:#06B6D4;">
                    <div>
                        <h5 class="font-bold text-lg flex items-center gap-2" style="color:#0891B2;">
                            <i class="fas fa-exclamation-triangle"></i>
                            Ada {{ $pendingApprovals->count() }} permohonan pending!
                        </h5>
                        <span class="text-gray-500 text-sm">Segera tinjau permohonan untuk menghindari antrian.</span>
                    </div>

                    <a href="{{ route('admin.borrows.pending') }}" class="px-4 py-2 text-white rounded-md text-sm"
                        style="background:#0891B2;">
                        <i class="fas fa-list mr-1"></i> Lihat
                    </a>
                </div>
            </div>
        @endif

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
