@extends('layouts.lessor')

@section('pageTitle', 'Bookings Management')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="h4 font-weight-bold text-dark mb-1">Bookings Management</h2>
                    <p class="mb-0 text-muted">View and manage all workspace bookings</p>
                </div>
                <div>
                    <a href="{{ route('lessor.dashboard') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form action="{{ route('lessor.bookings.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="workspace">Workspace</label>
                            <select class="form-control" id="workspace" name="workspace">
                                <option value="">All Workspaces</option>
                                @foreach($workspaces as $ws)
                                    <option value="{{ $ws->id }}" {{ request('workspace') == $ws->id ? 'selected' : '' }}>
                                        {{ $ws->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="">All Statuses</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="date">Date Range</label>
                            <input type="text" class="form-control date-range-picker" id="date" name="date"
                                   value="{{ request('date') }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter mr-2"></i>Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Bookings Table -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0">#</th>
                            <th class="border-0">Workspace</th>
                            <th class="border-0">Customer</th>
                            <th class="border-0">Dates</th>
                            <th class="border-0">Total</th>
                            <th class="border-0">Status</th>
                            <th class="border-0">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <a href="{{ route('lessor.workspaces.show', $booking->workspace_id) }}" class="text-primary">
                                    {{ $booking->workspace->title }}
                                </a>
                            </td>
                            <td>
                                {{ $booking->user->name }}
                                <small class="d-block text-muted">{{ $booking->user->email }}</small>
                            </td>
                            <td>
                                {{ $booking->start_date->format('M d, Y') }}
                                <span class="text-muted">to</span>
                                {{ $booking->end_date->format('M d, Y') }}
                                <small class="d-block text-muted">
                                    {{ $booking->days_count }} day(s)
                                </small>
                            </td>
                            <td>${{ number_format($booking->total_price, 2) }}</td>
                            <td>
                                <span class="badge
                                    @if($booking->status == 'approved') badge-success
                                    @elseif($booking->status == 'rejected') badge-danger
                                    @elseif($booking->status == 'pending') badge-warning
                                    @elseif($booking->status == 'completed') badge-info
                                    @else badge-secondary @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        <i class="fas fa-cog"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                           data-target="#bookingModal{{ $booking->id }}">
                                            <i class="fas fa-eye mr-2"></i>View Details
                                        </a>
                                        @if($booking->status == 'pending')
                                        <a class="dropdown-item text-success" href="#"
                                           onclick="event.preventDefault(); document.getElementById('approve-form-{{ $booking->id }}').submit();">
                                            <i class="fas fa-check-circle mr-2"></i>Approve
                                        </a>
                                        <form id="approve-form-{{ $booking->id }}"
                                              action="{{ route('lessor.bookings.update', $booking->id) }}"
                                              method="POST" style="display: none;">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="approved">
                                        </form>

                                        <a class="dropdown-item text-danger" href="#"
                                           onclick="event.preventDefault(); document.getElementById('reject-form-{{ $booking->id }}').submit();">
                                            <i class="fas fa-times-circle mr-2"></i>Reject
                                        </a>
                                        <form id="reject-form-{{ $booking->id }}"
                                              action="{{ route('lessor.bookings.update', $booking->id) }}"
                                              method="POST" style="display: none;">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="rejected">
                                        </form>
                                        @endif

                                        @if($booking->status == 'approved')
                                        <a class="dropdown-item text-info" href="#"
                                           onclick="event.preventDefault(); document.getElementById('complete-form-{{ $booking->id }}').submit();">
                                            <i class="fas fa-flag-checkered mr-2"></i>Mark as Completed
                                        </a>
                                        <form id="complete-form-{{ $booking->id }}"
                                              action="{{ route('lessor.bookings.update', $booking->id) }}"
                                              method="POST" style="display: none;">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="completed">
                                        </form>
                                        @endif

                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-primary" href="#" data-toggle="modal"
                                           data-target="#messageModal{{ $booking->id }}">
                                            <i class="fas fa-reply mr-2"></i>Send Message
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Booking Details Modal -->
                        <div class="modal fade" id="bookingModal{{ $booking->id }}" tabindex="-1" role="dialog"
                             aria-labelledby="bookingModalLabel{{ $booking->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="bookingModalLabel{{ $booking->id }}">
                                            Booking #{{ $booking->id }} Details
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="font-weight-bold">Workspace Information</h6>
                                                <p>
                                                    <strong>Title:</strong> {{ $booking->workspace->title }}<br>
                                                    <strong>Type:</strong> {{ $booking->workspace->space_type }}<br>
                                                    <strong>Location:</strong> {{ $booking->workspace->location }}
                                                </p>

                                                <h6 class="font-weight-bold mt-4">Booking Details</h6>
                                                <p>
                                                    <strong>Dates:</strong> {{ $booking->start_date->format('M d, Y') }} - {{ $booking->end_date->format('M d, Y') }}<br>
                                                    <strong>Duration:</strong> {{ $booking->days_count }} day(s)<br>
                                                    <strong>Price per day:</strong> ${{ number_format($booking->price_per_day, 2) }}<br>
                                                    <strong>Total Price:</strong> ${{ number_format($booking->total_price, 2) }}
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="font-weight-bold">Customer Information</h6>
                                                <p>
                                                    <strong>Name:</strong> {{ $booking->user->name }}<br>
                                                    <strong>Email:</strong> {{ $booking->user->email }}<br>
                                                    <strong>Phone:</strong> {{ $booking->user->phone ?? 'N/A' }}
                                                </p>

                                                <h6 class="font-weight-bold mt-4">Status History</h6>
                                                <ul class="list-group list-group-flush">
                                                    @foreach($booking->statusHistory as $history)
                                                    <li class="list-group-item p-2">
                                                        <small class="text-muted">{{ $history->created_at->format('M d, Y h:i A') }}</small><br>
                                                        Status changed to <span class="badge
                                                            @if($history->status == 'approved') badge-success
                                                            @elseif($history->status == 'rejected') badge-danger
                                                            @elseif($history->status == 'pending') badge-warning
                                                            @elseif($history->status == 'completed') badge-info
                                                            @else badge-secondary @endif">
                                                            {{ ucfirst($history->status) }}
                                                        </span>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Message Modal -->
                        <div class="modal fade" id="messageModal{{ $booking->id }}" tabindex="-1" role="dialog"
                             aria-labelledby="messageModalLabel{{ $booking->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="messageModalLabel{{ $booking->id }}">
                                            Send Message to {{ $booking->user->name }}
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('lessor.bookings.send-message', $booking->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="messageSubject{{ $booking->id }}">Subject</label>
                                                <input type="text" class="form-control" id="messageSubject{{ $booking->id }}"
                                                       name="subject" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="messageContent{{ $booking->id }}">Message</label>
                                                <textarea class="form-control" id="messageContent{{ $booking->id }}"
                                                          name="message" rows="5" required></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-paper-plane mr-2"></i>Send Message
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">No bookings found</h5>
                                <p class="text-muted">You don't have any bookings matching your criteria</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    @if($bookings->hasPages())
    <div class="row mt-4">
        <div class="col-12 d-flex justify-content-center">
            {{ $bookings->appends(request()->query())->links() }}
        </div>
    </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    .date-range-picker {
        background-color: white;
    }

    .badge {
        font-size: 0.85rem;
        font-weight: 500;
        padding: 0.35em 0.65em;
    }

    .dropdown-menu {
        min-width: 12rem;
    }

    .dropdown-item {
        padding: 0.5rem 1.5rem;
    }

    .dropdown-item i {
        width: 1.2rem;
        text-align: center;
    }

    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }

    .table td {
        vertical-align: middle;
    }

    .status-badge {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
    }
</style>
@endpush

@push('scripts')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize date range picker
    $('.date-range-picker').daterangepicker({
        opens: 'left',
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear',
            format: 'YYYY-MM-DD'
        }
    });

    $('.date-range-picker').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
    });

    $('.date-range-picker').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
});
</script>
@endpush
