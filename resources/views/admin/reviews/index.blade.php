@extends('layouts.admin')

@section('title', 'Manage Reviews')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage Reviews</h1>
    </div>

    <!-- Reviews Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">All Reviews</h6>
            <div>
                <a href="#" class="btn btn-sm btn-secondary shadow-sm" data-toggle="modal" data-target="#filterModal">
                    <i class="fas fa-filter fa-sm text-white-50"></i> Filter
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="reviewsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Workspace</th>
                            <th>Rating</th>
                            <th>Comment</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reviews as $review)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $review->user->name }}</td>
                            <td>{{ Str::limit($review->workspace->title, 15) }}</td>
                            <td>
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-secondary' }}"></i>
                                @endfor
                            </td>
                            <td>{{ Str::limit($review->comment, 30) }}</td>
                            <td>{{ $review->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="#" class="btn btn-sm btn-info mr-2" data-toggle="modal" data-target="#viewReviewModal{{ $review->id }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this review?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- View Review Modal -->
                        <div class="modal fade" id="viewReviewModal{{ $review->id }}" tabindex="-1" role="dialog" aria-labelledby="viewReviewModalLabel{{ $review->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewReviewModalLabel{{ $review->id }}">Review Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <div class="col-md-4 font-weight-bold">User:</div>
                                            <div class="col-md-8">{{ $review->user->name }}</div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4 font-weight-bold">Workspace:</div>
                                            <div class="col-md-8">{{ $review->workspace->title }}</div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4 font-weight-bold">Rating:</div>
                                            <div class="col-md-8">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-secondary' }}"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4 font-weight-bold">Date:</div>
                                            <div class="col-md-8">{{ $review->created_at->format('M d, Y H:i') }}</div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4 font-weight-bold">Comment:</div>
                                            <div class="col-md-8">{{ $review->comment }}</div>
                                        </div>
                                        @if($review->response)
                                        <div class="row mb-3">
                                            <div class="col-md-4 font-weight-bold">Response:</div>
                                            <div class="col-md-8">{{ $review->response }}</div>
                                        </div>
                                        @endif
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
        </div>
    </div>
</div>

<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Filter Reviews</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.reviews.index') }}" method="GET">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="rating">Rating</label>
                        <select class="form-control" id="rating" name="rating">
                            <option value="">All Ratings</option>
                            <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 Stars</option>
                            <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4 Stars</option>
                            <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3 Stars</option>
                            <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>2 Stars</option>
                            <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>1 Star</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="workspace_id">Workspace</label>
                        <select class="form-control" id="workspace_id" name="workspace_id">
                            <option value="">All Workspaces</option>
                            @foreach($workspacesList as $workspace)
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
                    <a href="{{ route('admin.reviews.index') }}" class="btn btn-outline-danger">Reset</a>
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

    .text-warning {
        color: #f6c23e !important;
    }

    .text-secondary {
        color: #858796 !important;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize DataTable
        $('#reviewsTable').DataTable({
            "order": [[5, "desc"]]
        });
    });
</script>
@endpush
