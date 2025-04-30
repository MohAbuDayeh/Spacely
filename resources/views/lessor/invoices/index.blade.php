@extends('layouts.lessor')

@section('pageTitle', 'Invoices')

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
                    <a class="nav-link {{ request()->routeIs('lessor.request-quote') ? 'active' : '' }}" href="#">
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

    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">My Invoices</h4>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Invoice Number</th>
                        <th>Renter Name</th>
                        <th>Amount (JOD)</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th>Paid At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $payment->invoice_number }}</td>
                            <td>{{ $payment->renter->name ?? 'N/A' }}</td>
                            <td>{{ $payment->amount }}</td>
                            <td>{{ ucfirst($payment->payment_method) }}</td>
                            <td>
                                @if($payment->status == 'paid')
                                    <span class="badge badge-success">Paid</span>
                                @elseif($payment->status == 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @else
                                    <span class="badge badge-danger">Failed</span>
                                @endif
                            </td>
                            <td>{{ $payment->paid_at ? $payment->paid_at->format('d M Y') : '-' }}</td>
                            <td>
                                <a href="{{ route('lessor.invoices.show', $payment->id) }}" class="btn btn-sm btn-outline-primary">
                                    View
                                </a>
                                <a href="{{ route('lessor.invoices.download', $payment->id) }}" class="btn btn-sm btn-outline-secondary">
                                    PDF
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No invoices found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
