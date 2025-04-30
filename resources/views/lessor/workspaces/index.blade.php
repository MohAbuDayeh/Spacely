@extends('layouts.lessor')

@section('pageTitle', 'Workspaces Management')

@section('content')
<div class="row">
    <!-- Sidebar Section -->
<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
<nav class="navbar navbar-expand-lg db-sidenav">
    <div class="collapse navbar-collapse" id="navbardbCollapse">
        <ul class="nav flex-column">
            <!-- Dashboard Link -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('lessor.dashboard') ? 'active' : '' }}" href="{{ route('lessor.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>Dashboard
                </a>
            </li>

            <!-- Workspaces Link -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('lessor.workspaces.index') ? 'active' : '' }}" href="{{ route('lessor.workspaces.index') }}">
                    <i class="fas fa-fw fa-list"></i>Workspaces
                </a>
            </li>

            <!-- Request Quote Link -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('lessor.request-quote') ? 'active' : '' }}" href="{{ route('lessor.request-quotes') }}">
                    <i class="fas fa-fw fa-receipt"></i>Request Quote
                </a>
            </li>

            <!-- Reviews Link -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('lessor.reviews') ? 'active' : '' }}" href="{{ route('lessor.reviews') }}">
                    <i class="fas fa-fw fa-star"></i>Reviews
                </a>
            </li>

            <!-- Invoice Link -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('lessor.invoices.index') ? 'active' : '' }}" href="{{ route('lessor.invoices.index') }}">
                    <i class="fas fa-fw fa-file-invoice"></i>Invoice
                </a>
            </li>

            <!-- My Plan Link -->
            {{-- <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('lessor.pricing-plan') ? 'active' : '' }}" href="#">
                    <i class="fas fa-fw fa-gem"></i>My Plan
                </a>
            </li> --}}

            <!-- Profile Link -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('lessor.profile') ? 'active' : '' }}" href="#">
                    <i class="fas fa-fw fa-user-circle"></i>Profile
                </a>
            </li>

            <!-- Logout Link -->
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link">
                        <i class="fas fa-fw fa-sign-out-alt"></i>Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>
</div>
    <!-- content start -->
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <!-- Header Section -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="row d-lg-flex justify-content-between align-items-center">
                                <div class="col-md-9">
                                    <h2 class="h3">Listing Management</h2>
                                    <p class="db-pageheader-text">Manage your office space listing in one single dashboard.</p>
                                </div>
                                <div class="col-md-3 text-right">
                                    <a href="{{ route('lessor.workspaces.create') }}" class="btn btn-secondary">Add new listing</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card-lines-tab">
                                <ul class="nav nav-pills card-header" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-listing-tab" data-toggle="pill" href="#pills-listing" role="tab" aria-controls="pills-listing" aria-selected="true">All Listing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-pending-tab" data-toggle="pill" href="#pills-pending" role="tab" aria-controls="pills-pending" aria-selected="false">Pending</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-approved-tab" data-toggle="pill" href="#pills-approved" role="tab" aria-controls="pills-approved" aria-selected="false">Approved</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-removed-tab" data-toggle="pill" href="#pills-removed" role="tab" aria-controls="pills-removed" aria-selected="false">Removed</a>
                                    </li>
                                </ul>
                                <div class="tab-content card" id="pills-tabContent">
                                    <!-- All Listings Tab -->
                                    <div class="tab-pane fade show active" id="pills-listing" role="tabpanel" aria-labelledby="pills-listing-tab">
                                        <div class="table-responsive listing-table">
                                            <table class="table first">
                                                <thead>
                                                    <tr>
                                                        <th>Image</th>
                                                        <th>Title</th>
                                                        <th>Date</th>
                                                        <th>Reviews</th>
                                                        <th>RQ</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($workspaces as $workspace)
                                                        <tr>
                                                            <td>
                                                                <div class="listing-table-img">
                                                                    <a href="#">
                                                                        <img src="{{ asset('assets/images/'.$workspace->image) }}" class="rounded">
                                                                    </a>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="listing-table-head">
                                                                    <h4 class="h6 text-truncate mb-0">
                                                                        <a href="#" class="text-dark">{{ $workspace->title }}</a>
                                                                    </h4>
                                                                    <p class="listing-table-head-text">{{ $workspace->location }}</p>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="font-14">
                                                                    <p>{{ $workspace->created_at->format('d M, Y') }}</p>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="listing-table-review">{{ $workspace->reviews_count }}</div>
                                                            </td>
                                                            <td>
                                                                <div class="listing-table-quote">{{ $workspace->quotes_count }}</div>
                                                            </td>
                                                            <td>
                                                                <div class="listing-table-status">
                                                                    <span class="badge badge-{{ $workspace->status == 'approved' ? 'success' : ($workspace->status == 'pending' ? 'warning' : 'danger') }}">
                                                                        {{ ucfirst($workspace->status) }}
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="listing-table-action">
                                                                    <div class="dropdown dropright">
                                                                        <a href="#" class="btn" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <i class="fas fa-ellipsis-v text-dark"></i>
                                                                        </a>
                                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                            <a class="dropdown-item" href="{{ route('lessor.workspaces.edit', $workspace->id) }}">Edit Details</a>
                                                                            <a class="dropdown-item" href="{{ route('lessor.workspaces.delete', $workspace->id) }}">Delete</a>
                                                                        </div>
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
                                    <div class="tab-pane fade" id="pills-pending" role="tabpanel" aria-labelledby="pills-pending-tab">
                                        <div class="table-responsive listing-table">
                                            <table class="table first">
                                                <thead>
                                                    <tr>
                                                        <th>Image</th>
                                                        <th>Title</th>
                                                        <th>Date</th>
                                                        <th>Reviews</th>
                                                        <th>RQ</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($pendingWorkspaces as $workspace)
                                                        <tr>
                                                            <td>
                                                                <div class="listing-table-img">
                                                                    <a href="#">
                                                                        <img src="{{ asset('assets/images/'.$workspace->image) }}" class="rounded">
                                                                    </a>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="listing-table-head">
                                                                    <h4 class="h6 text-truncate mb-0">
                                                                        <a href="#" class="text-dark">{{ $workspace->title }}</a>
                                                                    </h4>
                                                                    <p class="listing-table-head-text">{{ $workspace->location }}</p>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="font-14">
                                                                    <p>{{ $workspace->created_at->format('d M, Y') }}</p>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="listing-table-review">{{ $workspace->reviews_count }}</div>
                                                            </td>
                                                            <td>
                                                                <div class="listing-table-quote">{{ $workspace->quotes_count }}</div>
                                                            </td>
                                                            <td>
                                                                <div class="listing-table-status">
                                                                    <span class="badge badge-warning">{{ ucfirst($workspace->status) }}</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="listing-table-action">
                                                                    <div class="dropdown dropright">
                                                                        <a href="#" class="btn" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <i class="fas fa-ellipsis-v text-dark"></i>
                                                                        </a>
                                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                            <a class="dropdown-item" href="{{ route('lessor.workspaces.edit', $workspace->id) }}">Edit Details</a>
                                                                            <a class="dropdown-item" href="{{ route('lessor.workspaces.delete', $workspace->id) }}">Delete</a>
                                                                        </div>
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
                                    <div class="tab-pane fade" id="pills-approved" role="tabpanel" aria-labelledby="pills-approved-tab">
                                        <div class="table-responsive listing-table">
                                            <table class="table first">
                                                <thead>
                                                    <tr>
                                                        <th>Image</th>
                                                        <th>Title</th>
                                                        <th>Date</th>
                                                        <th>Reviews</th>
                                                        <th>RQ</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($approvedWorkspaces as $workspace)
                                                        <tr>
                                                            <td>
                                                                <div class="listing-table-img">
                                                                    <a href="#">
                                                                        <img src="{{ asset('assets/images/'.$workspace->image) }}" class="rounded">
                                                                    </a>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="listing-table-head">
                                                                    <h4 class="h6 text-truncate mb-0">
                                                                        <a href="#" class="text-dark">{{ $workspace->title }}</a>
                                                                    </h4>
                                                                    <p class="listing-table-head-text">{{ $workspace->location }}</p>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="font-14">
                                                                    <p>{{ $workspace->created_at->format('d M, Y') }}</p>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="listing-table-review">{{ $workspace->reviews_count }}</div>
                                                            </td>
                                                            <td>
                                                                <div class="listing-table-quote">{{ $workspace->quotes_count }}</div>
                                                            </td>
                                                            <td>
                                                                <div class="listing-table-status">
                                                                    <span class="badge badge-success">{{ ucfirst($workspace->status) }}</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="listing-table-action">
                                                                    <div class="dropdown dropright">
                                                                        <a href="#" class="btn" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <i class="fas fa-ellipsis-v text-dark"></i>
                                                                        </a>
                                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                            <a class="dropdown-item" href="{{ route('lessor.workspaces.edit', $workspace->id) }}">Edit Details</a>
                                                                            <a class="dropdown-item" href="{{ route('lessor.workspaces.delete', $workspace->id) }}">Delete</a>
                                                                        </div>
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
                                    <div class="tab-pane fade" id="pills-removed" role="tabpanel" aria-labelledby="pills-removed-tab">
                                        <div class="table-responsive listing-table">
                                            <table class="table first">
                                                <thead>
                                                    <tr>
                                                        <th>Image</th>
                                                        <th>Title</th>
                                                        <th>Date</th>
                                                        <th>Reviews</th>
                                                        <th>RQ</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($removedWorkspaces as $workspace)
                                                        <tr>
                                                            <td>
                                                                <div class="listing-table-img">
                                                                    <a href="#">
                                                                        <img src="{{ asset('assets/images/'.$workspace->image) }}" class="rounded">
                                                                    </a>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="listing-table-head">
                                                                    <h4 class="h6 text-truncate mb-0">
                                                                        <a href="#" class="text-dark">{{ $workspace->title }}</a>
                                                                    </h4>
                                                                    <p class="listing-table-head-text">{{ $workspace->location }}</p>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="font-14">
                                                                    <p>{{ $workspace->created_at->format('d M, Y') }}</p>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="listing-table-review">{{ $workspace->reviews_count }}</div>
                                                            </td>
                                                            <td>
                                                                <div class="listing-table-quote">{{ $workspace->quotes_count }}</div>
                                                            </td>
                                                            <td>
                                                                <div class="listing-table-status">
                                                                    <span class="badge badge-danger">{{ ucfirst($workspace->status) }}</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="listing-table-action">
                                                                    <div class="dropdown dropright">
                                                                        <a href="#" class="btn" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <i class="fas fa-ellipsis-v text-dark"></i>
                                                                        </a>
                                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                            <a class="dropdown-item" href="{{ route('lessor.workspaces.edit', $workspace->id) }}">Edit Details</a>
                                                                            <a class="dropdown-item" href="{{ route('lessor.workspaces.delete', $workspace->id) }}">Delete</a>
                                                                        </div>
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
    <!-- content close -->
@endsection
