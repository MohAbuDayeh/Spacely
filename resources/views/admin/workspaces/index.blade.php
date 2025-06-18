@extends('layouts.admin')

@section('title', 'Manage Workspaces')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage Workspaces</h1>
    </div>

    <!-- Workspaces Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">All Workspaces</h6>
            <div>
                <a href="#" class="btn btn-sm btn-secondary shadow-sm" data-toggle="modal" data-target="#filterModal">
                    <i class="fas fa-filter fa-sm text-white-50"></i> Filter
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="workspacesTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Owner</th>
                            <th>Type</th>
                            <th>Location</th>
                            <th>Price/Hour</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($workspaces as $workspace)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ Str::limit($workspace->title, 20) }}</td>
                            <td>{{ $workspace->user->name }}</td>
                            <td>{{ $workspace->space_type }}</td>
                            <td>{{ $workspace->governorate }}</td>
                            <td>${{ number_format($workspace->price_per_hour, 2) }}</td>
                            <td>
                                <span class="badge badge-{{ $workspace->status == 'available' ? 'success' : 'warning' }}">
                                    {{ ucfirst($workspace->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('renter.workspaces.show', $workspace->id) }}" class="btn btn-sm btn-info mr-2">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.workspaces.destroy', $workspace->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this workspace?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Filter Workspaces</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.workspaces.index') }}" method="GET">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="space_type">Space Type</label>
                        <select class="form-control" id="space_type" name="space_type">
                            <option value="">All Types</option>
                            <option value="Coworking space" {{ request('space_type') == 'Coworking space' ? 'selected' : '' }}>Coworking Space</option>
                            <option value="Meeting space" {{ request('space_type') == 'Meeting space' ? 'selected' : '' }}>Meeting Space</option>
                            <option value="Private Office" {{ request('space_type') == 'Private Office' ? 'selected' : '' }}>Private Office</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="governorate">Governorate</label>
                        <select class="form-control" id="governorate" name="governorate">
                            <option value="">All Governorates</option>
                            @foreach(['Amman','Zarqa','Irbid','Aqaba','Mafraq','Balqa','Karak','Madaba','Tafilah','Jerash','Ajloun','Maan'] as $gov)
                                <option value="{{ $gov }}" {{ request('governorate') == $gov ? 'selected' : '' }}>{{ $gov }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="">All Statuses</option>
                            <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                            <option value="booked" {{ request('status') == 'booked' ? 'selected' : '' }}>Booked</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                    <a href="{{ route('admin.workspaces.index') }}" class="btn btn-outline-danger">Reset</a>
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
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize DataTable
        $('#workspacesTable').DataTable({
            "order": [[0, "asc"]]
        });
    });
</script>
@endpush
