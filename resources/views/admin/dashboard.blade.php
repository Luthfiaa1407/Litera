@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6">

        <!-- Header + Quick Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <h2 class="text-3xl font-bold bg-gradient-to-r from-cyan-600 to-blue-600 bg-clip-text text-transparent">
                    Dashboard Admin
                </h2>
                <p class="text-sm text-gray-600 mt-2">Ringkasan cepat sistem dan tindakan cepat untuk admin.</p>
            </div>
            <div class="flex items-center gap-3 flex-wrap">
                <a href="{{ route('admin.books.create') }}"
                    class="group px-5 py-2.5 rounded-xl text-white text-sm font-medium shadow-lg shadow-cyan-500/30 hover:shadow-xl hover:shadow-cyan-500/40 transition-all duration-300 bg-gradient-to-r from-cyan-600 to-blue-600 hover:scale-105">
                    <i class="fas fa-plus mr-2"></i>Tambah Buku
                </a>
                <a href="{{ route('admin.categories.create') }}"
                    class="px-5 py-2.5 rounded-xl text-white text-sm font-medium shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40 transition-all duration-300 bg-gradient-to-r from-blue-500 to-indigo-600 hover:scale-105">
                    <i class="fas fa-tag mr-2"></i>Tambah Kategori
                </a>
                <a href="{{ route('admin.borrows.pending') }}"
                    class="px-5 py-2.5 rounded-xl border-2 border-gray-300 text-gray-700 text-sm font-medium hover:border-cyan-500 hover:text-cyan-600 hover:bg-cyan-50 transition-all duration-300">
                    <i class="fas fa-clipboard-check mr-2"></i>Tinjau Pinjaman
                </a>
            </div>
        </div>

        <!-- Quick Stats -->
        @php
            $stats = [
                [
                    'icon' => 'fa-hourglass-half',
                    'title' => 'Pending',
                    'value' => $pendingRequests ?? 0,
                    'link' => route('admin.borrows.pending'),
                    'color' => 'yellow',
                    'gradient' => 'from-yellow-400 to-orange-500',
                ],
                [
                    'icon' => 'fa-book-reader',
                    'title' => 'Dipinjam',
                    'value' => $activeBorrows ?? 0,
                    'link' => route('user.borrows.index'),
                    'color' => 'blue',
                    'gradient' => 'from-blue-400 to-cyan-500',
                ],
                [
                    'icon' => 'fa-check-circle',
                    'title' => 'Disetujui',
                    'value' => $approvedRequests ?? 0,
                    'link' => '#',
                    'color' => 'green',
                    'gradient' => 'from-green-400 to-emerald-500',
                ],
                [
                    'icon' => 'fa-users',
                    'title' => 'Users',
                    'value' => $totalUsers ?? 0,
                    'link' => route('admin.users.index'),
                    'color' => 'purple',
                    'gradient' => 'from-purple-400 to-pink-500',
                ],
                [
                    'icon' => 'fa-book',
                    'title' => 'Total Buku',
                    'value' => $totalBooks ?? 0,
                    'link' => route('admin.books.index'),
                    'color' => 'cyan',
                    'gradient' => 'from-cyan-400 to-blue-500',
                ],
            ];
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-5 mb-8">
            @foreach ($stats as $stat)
                <a href="{{ $stat['link'] }}" class="group no-underline">
                    <div
                        class="relative bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 p-6 border border-gray-100 hover:border-{{ $stat['color'] }}-300 overflow-hidden hover:-translate-y-1">

                        <!-- Decorative Background -->
                        <div
                            class="absolute -right-8 -top-8 w-32 h-32 bg-gradient-to-br {{ $stat['gradient'] }} opacity-10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500">
                        </div>

                        <div class="relative flex items-start gap-4">
                            <div
                                class="flex-shrink-0 w-14 h-14 rounded-xl bg-gradient-to-br {{ $stat['gradient'] }} flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <i class="fas {{ $stat['icon'] }} text-2xl text-white"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">
                                    {{ $stat['title'] }}</div>
                                <div
                                    class="text-3xl font-bold bg-gradient-to-r {{ $stat['gradient'] }} bg-clip-text text-transparent">
                                    {{ $stat['value'] }}</div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Pending Approvals -->
        <div class="mb-8">
            <div
                class="relative overflow-hidden bg-gradient-to-r from-cyan-50 to-blue-50 p-6 rounded-2xl border-l-4 border-cyan-500 shadow-md">
                <div class="absolute top-0 right-0 w-64 h-64 bg-cyan-200/20 rounded-full -mr-32 -mt-32 blur-3xl"></div>

                <div class="relative flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <h5 class="font-bold text-xl flex items-center gap-3 text-cyan-700 mb-2">
                            <div class="w-10 h-10 rounded-lg bg-yellow-400 flex items-center justify-center shadow-lg">
                                <i class="fas fa-exclamation-triangle text-white"></i>
                            </div>
                            <span id="pendingCount"
                                class="text-2xl">{{ isset($pendingApprovals) ? $pendingApprovals->count() : 0 }}</span>
                            <span>permohonan pending</span>
                        </h5>
                        <span class="text-gray-600 text-sm ml-14">Segera tinjau permohonan untuk menghindari antrian.</span>
                    </div>

                    <div class="flex items-center gap-3">
                        <button id="togglePending"
                            class="px-5 py-2.5 rounded-xl border-2 border-cyan-600 text-cyan-600 font-medium hover:bg-cyan-600 hover:text-white transition-all duration-300">
                            <i class="fas fa-eye mr-2"></i>Tampilkan
                        </button>
                        <a href="{{ route('admin.borrows.pending') }}"
                            class="px-5 py-2.5 rounded-xl text-white font-medium shadow-lg bg-gradient-to-r from-cyan-600 to-blue-600 hover:shadow-xl transition-all duration-300">
                            <i class="fas fa-list mr-2"></i>Lihat Semua
                        </a>
                    </div>
                </div>
            </div>

            <div id="pendingList" class="mt-4 hidden">
                @if (isset($pendingApprovals) && $pendingApprovals->count() > 0)
                    <div class="bg-white rounded-2xl shadow-lg p-5 border border-gray-100">
                        <ul class="space-y-3">
                            @foreach ($pendingApprovals as $p)
                                <li
                                    class="p-4 border-2 border-gray-100 rounded-xl hover:border-cyan-300 hover:bg-cyan-50/50 transition-all duration-300">
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center text-white font-bold shadow-md">
                                                {{ substr($p->user->name ?? 'N', 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="font-semibold text-gray-800">{{ $p->user->name ?? 'N/A' }}
                                                </div>
                                                <div class="text-sm text-gray-500">{{ $p->book->title ?? 'N/A' }}</div>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="#"
                                                class="px-4 py-2 rounded-lg bg-gradient-to-r from-yellow-400 to-orange-500 text-white text-sm font-medium shadow-md hover:shadow-lg transition-all duration-300">
                                                <i class="fas fa-info-circle mr-2"></i>Detail
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <div class="bg-white rounded-2xl shadow-lg p-6 text-center text-gray-500 border border-gray-100">
                        <i class="fas fa-check-circle text-5xl text-green-400 mb-3"></i>
                        <p class="font-medium">Tidak ada permohonan pending.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Latest Activities -->
        <div>
            <h4
                class="text-2xl font-bold mb-5 bg-gradient-to-r from-cyan-600 to-blue-600 bg-clip-text text-transparent flex items-center gap-2">
                <i class="fas fa-history text-cyan-600"></i>
                Aktivitas Terbaru
            </h4>

            <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
                @if (isset($recentActivities) && $recentActivities->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead class="bg-gradient-to-r from-cyan-600 to-blue-600 text-white">
                                <tr>
                                    <th class="text-left p-4 font-semibold">Peminjam</th>
                                    <th class="text-left p-4 font-semibold">Buku</th>
                                    <th class="text-left p-4 font-semibold">Status</th>
                                    <th class="text-left p-4 font-semibold">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($recentActivities as $activity)
                                    <tr
                                        class="hover:bg-gradient-to-r hover:from-cyan-50 hover:to-blue-50 transition-all duration-200">
                                        <td class="p-4">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-9 h-9 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center text-white font-bold text-sm shadow-md">
                                                    {{ substr($activity->user->name ?? 'N', 0, 1) }}
                                                </div>
                                                <span
                                                    class="font-medium text-gray-800">{{ $activity->user->name ?? 'N/A' }}</span>
                                            </div>
                                        </td>
                                        <td class="p-4 font-medium text-gray-700">{{ $activity->book->title ?? 'N/A' }}
                                        </td>
                                        <td class="p-4">
                                            <span
                                                class="px-3 py-1.5 rounded-full text-white text-xs font-semibold shadow-md
                                                @if ($activity->status == 'pending') bg-gradient-to-r from-yellow-400 to-orange-500
                                                @elseif($activity->status == 'active') bg-gradient-to-r from-blue-500 to-cyan-600
                                                @elseif($activity->status == 'approved') bg-gradient-to-r from-cyan-500 to-teal-500
                                                @elseif($activity->status == 'returned') bg-gradient-to-r from-green-500 to-emerald-600
                                                @elseif($activity->status == 'rejected') bg-gradient-to-r from-red-500 to-pink-600
                                                @else bg-gradient-to-r from-gray-500 to-gray-600 @endif">
                                                {{ ucfirst($activity->status) }}
                                            </span>
                                        </td>
                                        <td class="p-4 text-gray-600 text-sm">
                                            {{ $activity->created_at->format('d M Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-12 text-center">
                        <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500 font-medium text-lg">Belum ada aktivitas terbaru.</p>
                    </div>
                @endif
            </div>
        </div>

    </div>

    <script>
        document.getElementById('togglePending')?.addEventListener('click', function() {
            const list = document.getElementById('pendingList');
            const btn = this;

            if (list.classList.contains('hidden')) {
                list.classList.remove('hidden');
                btn.innerHTML = '<i class="fas fa-eye-slash mr-2"></i>Sembunyikan';
            } else {
                list.classList.add('hidden');
                btn.innerHTML = '<i class="fas fa-eye mr-2"></i>Tampilkan';
            }
        });
    </script>
@endsection
