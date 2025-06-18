@extends('layouts.admin')

@section('title', 'Manage Bookings')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage Bookings</h1>
    </div>

    <!-- Bookings Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">All Bookings</h6>
            <div>
                <a href="#" class="btn btn-sm btn-secondary shadow-sm" data-toggle="modal" data-target="#filterModal">
                    <i class="fas fa-filter fa-sm text-white-50"></i> Filter
                </a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered" id="bookingsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Workspace</th>
                            <th>User</th>
                            <th>Booking Period</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                        <tr>
                            <td>{{ $loop->iteration + (($bookings->currentPage() - 1) * $bookings->perPage()) }}</td>
                            <td>{{ Str::limit($booking->workspace->title, 20) }}</td>
                            <td>{{ $booking->user->name }}</td>
                            <td>
                                {{ $booking->start_time->format('M d, Y H:i') }}<br>
                                to<br>
                                {{ $booking->end_time->format('M d, Y H:i') }}
                            </td>
                            <td>${{ number_format($booking->total_price, 2) }}</td>
                            <td>
                                <span class="badge badge-{{ $booking->status == 'confirmed' ? 'success' : ($booking->status == 'pending' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td>{{ $booking->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="#" class="btn btn-sm btn-info mr-2" data-toggle="modal" data-target="#viewBookingModal{{ $booking->id }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this booking?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- View Booking Modal -->
                        <div class="modal fade" id="viewBookingModal{{ $booking->id }}" tabindex="-1" role="dialog" aria-labelledby="viewBookingModalLabel{{ $booking->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewBookingModalLabel{{ $booking->id }}">Booking Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card mb-4">
                                                    <div class="card-header">
                                                        <h6 class="m-0 font-weight-bold text-primary">Workspace Information</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row mb-2">
                                                            <div class="col-sm-4 font-weight-bold">Title:</div>
                                                            <div class="col-sm-8">{{ $booking->workspace->title }}</div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-sm-4 font-weight-bold">Type:</div>
                                                            <div class="col-sm-8">{{ $booking->workspace->space_type }}</div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-sm-4 font-weight-bold">Location:</div>
                                                            <div class="col-sm-8">{{ $booking->workspace->governorate }}</div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-sm-4 font-weight-bold">Capacity:</div>
                                                            <div class="col-sm-8">{{ $booking->workspace->people_capacity }} people</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card mb-4">
                                                    <div class="card-header">
                                                        <h6 class="m-0 font-weight-bold text-primary">User Information</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row mb-2">
                                                            <div class="col-sm-4 font-weight-bold">Name:</div>
                                                            <div class="col-sm-8">{{ $booking->user->name }}</div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-sm-4 font-weight-bold">Email:</div>
                                                            <div class="col-sm-8">{{ $booking->user->email }}</div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-sm-4 font-weight-bold">Phone:</div>
                                                            <div class="col-sm-8">{{ $booking->user->phone }}</div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-sm-4 font-weight-bold">Role:</div>
                                                            <div class="col-sm-8">
                                                                <span class="badge badge-{{ $booking->user->role == 'admin' ? 'danger' : ($booking->user->role == 'lessor' ? 'primary' : 'success') }}">
                                                                    {{ ucfirst($booking->user->role) }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <h6 class="m-0 font-weight-bold text-primary">Booking Details</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row mb-2">
                                                    <div class="col-sm-3 font-weight-bold">Status:</div>
                                                    <div class="col-sm-9">
                                                        <span class="badge badge-{{ $booking->status == 'confirmed' ? 'success' : ($booking->status == 'pending' ? 'warning' : 'danger') }}">
                                                            {{ ucfirst($booking->status) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-3 font-weight-bold">Start Time:</div>
                                                    <div class="col-sm-9">{{ $booking->start_time->format('M d, Y H:i') }}</div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-3 font-weight-bold">End Time:</div>
                                                    <div class="col-sm-9">{{ $booking->end_time->format('M d, Y H:i') }}</div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-3 font-weight-bold">Duration:</div>
                                                    <div class="col-sm-9">{{ $booking->start_time->diffForHumans($booking->end_time, true) }}</div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-3 font-weight-bold">Total Price:</div>
                                                    <div class="col-sm-9">${{ number_format($booking->total_price, 2) }}</div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-3 font-weight-bold">Created At:</div>
                                                    <div class="col-sm-9">{{ $booking->created_at->format('M d, Y H:i') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $bookings->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Filter Bookings</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.bookings.index') }}" method="GET">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="">All Statuses</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="user_id">User</label>
                        <select class="form-control" id="user_id" name="user_id">
                            <option value="">All Users</option>
                            @foreach($bookings->pluck('user')->unique() as $user)
                                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="workspace_id">Workspace</label>
                        <select class="form-control" id="workspace_id" name="workspace_id">
                            <option value="">All Workspaces</option>
                            @foreach($bookings->pluck('workspace')->unique() as $workspace)
                                <option value="{{ $workspace->id }}" {{ request('workspace_id') == $workspace->id ? 'selected' : '' }}>
                                    {{ $workspace->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date_from">From Date</label>
                        <input type="date" class="form-control" id="date_from" name="date_from" value="{{ request('date_from') }}">
                    </div>
                    <div class="form-group">
                        <label for="date_to">To Date</label>
                        <input type="date" class="form-control" id="date_to" name="date_to" value="{{ request('date_to') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-danger">Reset</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .table-responsive {
        overflow-x: auto;
    }

    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #858796;
    }

    .table th,
    .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #e3e6f0;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #e3e6f0;
        background-color: #f8f9fc;
    }

    .badge {
        font-size: 0.75em;
        font-weight: 600;
        padding: 0.35em 0.65em;
    }

    .badge-success {
        background-color: #1cc88a;
    }

    .badge-warning {
        background-color: #f6c23e;
    }

    .badge-danger {
        background-color: #e74a3b;
    }

    .badge-primary {
        background-color: #4e73df;
    }

    .pagination {
        justify-content: center;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize any scripts if needed
    });
</script>
@endpush
