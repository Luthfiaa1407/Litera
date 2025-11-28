@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4 fw-bold">Pending Borrow Requests</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body table-responsive">

            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Book</th>
                        <th>Borrow Date</th>
                        <th>Return Date</th>
                        <th>Request Date</th>
                        <th>Status</th>
                        <th style="width: 210px;">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pendingBorrows as $borrow)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $borrow->user->name }}</td>
                            <td>{{ $borrow->book->title }}</td>
                            <td>{{ $borrow->borrow_date->format('d M Y') }}</td>
                            <td>{{ $borrow->return_date->format('d M Y') }}</td>
                            <td>{{ $borrow->request_date->format('d M Y H:i') }}</td>
                            <td>
                                <span class="badge bg-warning text-dark">
                                    {{ ucfirst($borrow->status) }}
                                </span>
                            </td>

                            <td>
                                <div class="d-flex gap-2">

                                    {{-- APPROVE --}}
                                    <form action="{{ route('admin.borrows.approve', $borrow->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">
                                            Approve
                                        </button>
                                    </form>

                                    {{-- REJECT --}}
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $borrow->id }}">
                                        Reject
                                    </button>

                                </div>

                                {{-- MODAL REJECT --}}
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
                                                    <label class="form-label">Admin Notes</label>
                                                    <textarea name="admin_notes" class="form-control" rows="3" required></textarea>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
                        <td colspan="8" class="text-center py-4">
                            <strong>No pending requests found.</strong>
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>
</div>
@endsection
