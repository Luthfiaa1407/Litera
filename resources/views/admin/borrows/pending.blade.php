@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">

    <h2 class="text-2xl font-bold mb-6" style="color: var(--color-primary-dark);">
        Pending Borrow Requests
    </h2>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg shadow">
            {{ session('success') }}
        </div>
    @endif

    {{-- ERROR --}}
    @if($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg shadow">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="bg-white shadow-lg rounded-xl border border-gray-200 overflow-hidden">

        <table class="min-w-full text-sm">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="py-3 px-4 text-left font-semibold">#</th>
                    <th class="py-3 px-4 text-left font-semibold">User</th>
                    <th class="py-3 px-4 text-left font-semibold">Book</th>
                    <th class="py-3 px-4 text-left font-semibold">Borrow Date</th>
                    <th class="py-3 px-4 text-left font-semibold">Return Date</th>
                    <th class="py-3 px-4 text-left font-semibold">Request Date</th>
                    <th class="py-3 px-4 text-left font-semibold">Status</th>
                    <th class="py-3 px-4 text-center font-semibold">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($pendingBorrows as $borrow)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="py-3 px-4">{{ $loop->iteration }}</td>

                        <td class="py-3 px-4">
                            {{ $borrow->user->name }}
                        </td>

                        <td class="py-3 px-4">
                            {{ $borrow->book->title }}
                        </td>

                        <td class="py-3 px-4">
                            {{ \Carbon\Carbon::parse($borrow->borrow_date)->format('d M Y') }}
                        </td>

                        <td class="py-3 px-4">
                            {{ \Carbon\Carbon::parse($borrow->return_date)->format('d M Y') }}
                        </td>

                        <td class="py-3 px-4">
                            {{ \Carbon\Carbon::parse($borrow->request_date)->format('d M Y H:i') }}
                        </td>

                        <td class="py-3 px-4">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-200 text-yellow-800">
                                Pending
                            </span>
                        </td>

                        <td class="py-3 px-4 text-center">

                            <div class="flex gap-2 justify-center">

                                {{-- APPROVE --}}
                                <form action="{{ route('admin.borrows.approve', $borrow->id) }}" method="POST">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="px-4 py-2 rounded-lg bg-green-500 hover:bg-green-600 text-white text-xs font-semibold shadow">
                                        Approve
                                    </button>
                                </form>

                                {{-- REJECT BUTTON --}}
                                <button
                                    class="px-4 py-2 rounded-lg bg-red-500 hover:bg-red-600 text-white text-xs font-semibold shadow"
                                    data-bs-toggle="modal"
                                    data-bs-target="#rejectModal{{ $borrow->id }}">
                                    Reject
                                </button>

                            </div>

                            {{-- REJECT MODAL --}}
                            <div class="modal fade" id="rejectModal{{ $borrow->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">Reject Request</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <form action="{{ route('admin.borrows.reject', $borrow->id) }}" method="POST">
                                            @csrf

                                            <div class="modal-body">
                                                <label class="form-label">Admin Notes (Wajib)</label>
                                                <textarea name="admin_notes" class="form-control" rows="3" required></textarea>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>

                                                <button type="submit" class="btn btn-danger">Reject</button>
                                            </div>

                                        </form>

                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="8" class="text-center py-6 text-gray-600">
                            Tidak ada pending request.
                        </td>
                    </tr>

                @endforelse
            </tbody>
        </table>

    </div>

</div>
@endsection
