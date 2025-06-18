@extends('layouts.lessor')

@section('pageTitle', 'Workspaces Management')

@section('content')
<div class="row no-gutters db-main-container">
    <!-- Sidebar Section - Professional Design -->
    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-12 db-sidenav-container">
        <nav class="navbar navbar-expand-lg db-sidenav h-100">
            <div class="collapse navbar-collapse h-100 d-flex flex-column" id="navbardbCollapse">
                <div class="db-sidebar-header py-4 px-3 text-center">
                    <img src="{{ asset('assets/images/spacely-logo.svg') }}" alt="Logo" class="img-fluid mb-3" width="120">
                    <h5 class="text-white mb-0">{{ Auth::user()->name }}</h5>
                    <small class="text-light">Lessor Dashboard</small>
                </div>

                <ul class="nav flex-column w-100 db-sidebar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('lessor.dashboard') ? 'active' : '' }}"
                           href="{{ route('lessor.dashboard') }}">
                            <i class="fas fa-fw fa-tachometer-alt mr-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('lessor.workspaces.index') ? 'active' : '' }}"
                           href="{{ route('lessor.workspaces.index') }}">
                            <i class="fas fa-fw fa-list mr-2"></i>Workspaces
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('lessor.request-quote') ? 'active' : '' }}"
                           href="{{ route('lessor.request-quotes') }}">
                            <i class="fas fa-fw fa-receipt mr-2"></i>Request Quote
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('lessor.reviews') ? 'active' : '' }}"
                           href="{{ route('lessor.reviews') }}">
                            <i class="fas fa-fw fa-star mr-2"></i>Reviews
                        </a>
                    </li>
                    <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('lessor.bookings.index') ? 'active' : '' }}"
                                    href="{{ route('lessor.bookings.index') }}">
                                    <i class="fas fa-fw fa-calendar-check mr-2"></i>Bookings
                                </a>
                            </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('lessor.invoices.index') ? 'active' : '' }}"
                                href="{{ route('lessor.invoices.index') }}">
                                <i class="fas fa-fw fa-file-invoice mr-2"></i>Invoices
                            </a>
                        </li> --}}
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('lessor.profile') ? 'active' : '' }}"
                           href="{{ route('lessor.profile.show', ['id' => auth()->id()]) }}">
                            <i class="fas fa-fw fa-user-circle mr-2"></i>Profile
                        </a>
                    </li>
                </ul>

                <div class="mt-auto db-sidebar-footer p-3">
                    <form action="{{ route('logout') }}" method="POST" class="w-100">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-block">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    </div>

    <!-- Main Content Section -->
    <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 db-main-content">
        <div class="container-fluid py-4">
            <!-- Header Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="h4 font-weight-bold text-dark mb-1">Listing Management</h2>
                            <p class="mb-0 text-muted">Manage your workspaces and listings</p>
                        </div>
                        <a href="{{ route('lessor.workspaces.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus mr-2"></i>Add New Listing
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tabs Navigation -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white border-bottom-0">
                            <ul class="nav nav-tabs card-header-tabs" id="workspaceTabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab">
                                        All Listings <span class="badge badge-primary ml-2">{{ $workspaces->count() }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pending-tab" data-toggle="tab" href="#pending" role="tab">
                                        Pending <span class="badge badge-warning ml-2">{{ $pendingWorkspaces->count() }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="approved-tab" data-toggle="tab" href="#approved" role="tab">
                                        Approved <span class="badge badge-success ml-2">{{ $approvedWorkspaces->count() }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="removed-tab" data-toggle="tab" href="#removed" role="tab">
                                        Removed <span class="badge badge-danger ml-2">{{ $removedWorkspaces->count() }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- Tabs Content -->
                        <div class="card-body p-0">
                            <div class="tab-content" id="workspaceTabsContent">
                                <!-- All Listings Tab -->
                                <div class="tab-pane fade show active" id="all" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Title</th>
                                                    <th>Location</th>
                                                    <th>Date</th>
                                                    <th>Reviews</th>
                                                    <th>Quotes</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($workspaces as $workspace)
                                                <tr>
                                                    <td>
                                                        @if($workspace->images)
                                                            <img src="{{ asset('storage/' . json_decode($workspace->images)[0]) }}"
                                                                 class="rounded"
                                                                 style="width: 80px; height: 60px; object-fit: cover;">
                                                        @else
                                                            <div class="bg-light rounded" style="width: 80px; height: 60px;"></div>
                                                        @endif
                                                    </td>
                                                    <td class="align-middle">
                                                        <a href="{{ route('lessor.workspaces.show', $workspace->id) }}" class="text-dark font-weight-bold">
                                                            {{ Str::limit($workspace->title, 30) }}
                                                        </a>
                                                    </td>
                                                    <td class="align-middle">{{ Str::limit($workspace->location, 20) }}</td>
                                                    <td class="align-middle">{{ $workspace->created_at->format('M d, Y') }}</td>
                                                    <td class="align-middle text-center">{{ $workspace->reviews_count }}</td>
                                                    <td class="align-middle text-center">{{ $workspace->quotes_count }}</td>
                                                    <td class="align-middle">
                                                        <span class="badge badge-{{ $workspace->status == 'approved' ? 'success' : ($workspace->status == 'pending' ? 'warning' : 'danger') }}">
                                                            {{ ucfirst($workspace->status) }}
                                                        </span>
                                                    </td>
                                                    <td class="align-middle">
                                                        <div class="dropdown">
                                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                                    type="button"
                                                                    data-toggle="dropdown">
                                                                Actions
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="{{ route('lessor.workspaces.edit', $workspace->id) }}">
                                                                    <i class="fas fa-edit mr-2"></i>Edit
                                                                </a>
                                                                <a class="dropdown-item" href="{{ route('lessor.workspaces.show', $workspace->id) }}">
                                                                    <i class="fas fa-eye mr-2"></i>View
                                                                </a>
                                                                <form action="{{ route('lessor.workspaces.destroy', $workspace->id) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure?')">
                                                                        <i class="fas fa-trash mr-2"></i>Delete
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Pending Listings Tab -->
                                <div class="tab-pane fade" id="pending" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Title</th>
                                                    <th>Location</th>
                                                    <th>Date</th>
                                                    <th>Reviews</th>
                                                    <th>Quotes</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($pendingWorkspaces as $workspace)
                                                <tr>
                                                    <td>
                                                        @if($workspace->images)
                                                            <img src="{{ asset('storage/' . json_decode($workspace->images)[0]) }}"
                                                                 class="rounded"
                                                                 style="width: 80px; height: 60px; object-fit: cover;">
                                                        @else
                                                            <div class="bg-light rounded" style="width: 80px; height: 60px;"></div>
                                                        @endif
                                                    </td>
                                                    <td class="align-middle">
                                                        <a href="{{ route('lessor.workspaces.show', $workspace->id) }}" class="text-dark font-weight-bold">
                                                            {{ Str::limit($workspace->title, 30) }}
                                                        </a>
                                                    </td>
                                                    <td class="align-middle">{{ Str::limit($workspace->location, 20) }}</td>
                                                    <td class="align-middle">{{ $workspace->created_at->format('M d, Y') }}</td>
                                                    <td class="align-middle text-center">{{ $workspace->reviews_count }}</td>
                                                    <td class="align-middle text-center">{{ $workspace->quotes_count }}</td>
                                                    <td class="align-middle">
                                                        <span class="badge badge-warning">Pending</span>
                                                    </td>
                                                    <td class="align-middle">
                                                        <div class="dropdown">
                                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                                    type="button"
                                                                    data-toggle="dropdown">
                                                                Actions
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="{{ route('lessor.workspaces.edit', $workspace->id) }}">
                                                                    <i class="fas fa-edit mr-2"></i>Edit
                                                                </a>
                                                                <a class="dropdown-item" href="{{ route('lessor.workspaces.show', $workspace->id) }}">
                                                                    <i class="fas fa-eye mr-2"></i>View
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Approved Listings Tab -->
                                <div class="tab-pane fade" id="approved" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Title</th>
                                                    <th>Location</th>
                                                    <th>Date</th>
                                                    <th>Reviews</th>
                                                    <th>Quotes</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($approvedWorkspaces as $workspace)
                                                <tr>
                                                    <td>
                                                        @if($workspace->images)
                                                            <img src="{{ asset('storage/' . json_decode($workspace->images)[0]) }}"
                                                                 class="rounded"
                                                                 style="width: 80px; height: 60px; object-fit: cover;">
                                                        @else
                                                            <div class="bg-light rounded" style="width: 80px; height: 60px;"></div>
                                                        @endif
                                                    </td>
                                                    <td class="align-middle">
                                                        <a href="{{ route('lessor.workspaces.show', $workspace->id) }}" class="text-dark font-weight-bold">
                                                            {{ Str::limit($workspace->title, 30) }}
                                                        </a>
                                                    </td>
                                                    <td class="align-middle">{{ Str::limit($workspace->location, 20) }}</td>
                                                    <td class="align-middle">{{ $workspace->created_at->format('M d, Y') }}</td>
                                                    <td class="align-middle text-center">{{ $workspace->reviews_count }}</td>
                                                    <td class="align-middle text-center">{{ $workspace->quotes_count }}</td>
                                                    <td class="align-middle">
                                                        <span class="badge badge-success">Approved</span>
                                                    </td>
                                                    <td class="align-middle">
                                                        <div class="dropdown">
                                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                                    type="button"
                                                                    data-toggle="dropdown">
                                                                Actions
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="{{ route('lessor.workspaces.edit', $workspace->id) }}">
                                                                    <i class="fas fa-edit mr-2"></i>Edit
                                                                </a>
                                                                <a class="dropdown-item" href="{{ route('lessor.workspaces.show', $workspace->id) }}">
                                                                    <i class="fas fa-eye mr-2"></i>View
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Removed Listings Tab -->
                                <div class="tab-pane fade" id="removed" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Title</th>
                                                    <th>Location</th>
                                                    <th>Date</th>
                                                    <th>Reviews</th>
                                                    <th>Quotes</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($removedWorkspaces as $workspace)
                                                <tr>
                                                    <td>
                                                        @if($workspace->images)
                                                            <img src="{{ asset('storage/' . json_decode($workspace->images)[0]) }}"
                                                                 class="rounded"
                                                                 style="width: 80px; height: 60px; object-fit: cover;">
                                                        @else
                                                            <div class="bg-light rounded" style="width: 80px; height: 60px;"></div>
                                                        @endif
                                                    </td>
                                                    <td class="align-middle">
                                                        <a href="{{ route('lessor.workspaces.show', $workspace->id) }}" class="text-dark font-weight-bold">
                                                            {{ Str::limit($workspace->title, 30) }}
                                                        </a>
                                                    </td>
                                                    <td class="align-middle">{{ Str::limit($workspace->location, 20) }}</td>
                                                    <td class="align-middle">{{ $workspace->created_at->format('M d, Y') }}</td>
                                                    <td class="align-middle text-center">{{ $workspace->reviews_count }}</td>
                                                    <td class="align-middle text-center">{{ $workspace->quotes_count }}</td>
                                                    <td class="align-middle">
                                                        <span class="badge badge-danger">Removed</span>
                                                    </td>
                                                    <td class="align-middle">
                                                        <div class="dropdown">
                                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                                    type="button"
                                                                    data-toggle="dropdown">
                                                                Actions
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="{{ route('lessor.workspaces.edit', $workspace->id) }}">
                                                                    <i class="fas fa-edit mr-2"></i>Edit
                                                                </a>
                                                                <a class="dropdown-item" href="{{ route('lessor.workspaces.show', $workspace->id) }}">
                                                                    <i class="fas fa-eye mr-2"></i>View
                                                                </a>
                                                            </div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    :root {
        --sidebar-width: 250px;
        --sidebar-bg: #2c3e50;
        --sidebar-active-bg: #34495e;
        --sidebar-text: #ecf0f1;
        --sidebar-active-text: #3498db;
        --main-bg: #f8f9fc;
        --card-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    }

    body {
        background-color: var(--main-bg);
        overflow-x: hidden;
    }

    .db-main-container {
        min-height: 100vh;
    }

    /* Sidebar Styles */
    .db-sidenav-container {
        background-color: var(--sidebar-bg);
        min-height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        width: var(--sidebar-width);
        z-index: 1000;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        transition: all 0.3s;
    }

    .db-sidebar-header {
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .db-sidebar-nav .nav-link {
        color: #ffffff !important;
        padding: 12px 20px;
        margin: 2px 0;
        border-radius: 0;
        transition: all 0.3s;
    }

    .db-sidebar-nav .nav-link:hover {
        background-color: var(--sidebar-active-bg);
        color: var(--sidebar-active-text);
    }

    .db-sidebar-nav .nav-link.active {
        background-color: var(--sidebar-active-bg);
        color: var(--sidebar-active-text);
        border-left: 4px solid var(--sidebar-active-text);
    }

    .db-sidebar-nav .nav-link i {
        width: 20px;
        text-align: center;
    }

    .db-sidebar-footer {
        border-top: 1px solid rgba(255,255,255,0.1);
    }

    /* Main Content Styles */
    .db-main-content {
        margin-left: var(--sidebar-width);
        width: calc(100% - var(--sidebar-width));
        padding: 20px;
    }

    .card {
        border: none;
        border-radius: 0.35rem;
        box-shadow: var(--card-shadow);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1.5rem 0 rgba(58, 59, 69, 0.2);
    }

    .card-header {
        background-color: #f8f9fc;
        border-bottom: 1px solid #e3e6f0;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }

    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
    }

    /* Custom styles for workspaces management */
    .nav-tabs .nav-link {
        border: none;
        color: #6c757d;
        font-weight: 500;
        padding: 1rem 1.5rem;
    }

    .nav-tabs .nav-link.active {
        color: #3498db;
        border-bottom: 3px solid #3498db;
        background-color: transparent;
    }

    .nav-tabs .nav-link:hover {
        border-color: transparent;
        color: #3498db;
    }

    .table th {
        border-top: none;
        font-weight: 600;
        color: #495057;
    }

    /* Responsive Adjustments */
    @media (max-width: 992px) {
        .db-sidenav-container {
            width: 80px;
            overflow: hidden;
        }

        .db-main-content {
            margin-left: 80px;
            width: calc(100% - 80px);
        }

        .db-sidebar-header,
        .db-sidebar-nav .nav-link span,
        .db-sidebar-footer .btn span {
            display: none;
        }

        .db-sidebar-nav .nav-link {
            text-align: center;
            padding: 12px 5px;
        }

        .db-sidebar-nav .nav-link i {
            margin-right: 0;
            font-size: 1.2rem;
        }
    }

    @media (max-width: 768px) {
        .db-sidenav-container {
            width: 0;
        }

        .db-main-content {
            margin-left: 0;
            width: 100%;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize tab functionality
        $('#workspaceTabs a').on('click', function (e) {
            e.preventDefault();
            $(this).tab('show');
        });

        // Highlight current tab
        $('.nav-tabs .nav-link').on('shown.bs.tab', function() {
            localStorage.setItem('lastTab', $(this).attr('id'));
        });

        // Restore last active tab
        var lastTab = localStorage.getItem('lastTab');
        if (lastTab) {
            $('#' + lastTab).tab('show');
        }

        // Add active class to current nav item
        const currentPath = window.location.pathname;
        document.querySelectorAll('.db-sidebar-nav .nav-link').forEach(link => {
            if (link.href.includes(currentPath)) {
                link.classList.add('active');
            }
        });
    });
</script>
@endpush

@endsection
