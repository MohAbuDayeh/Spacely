@extends('layouts.lessor')

@section('pageTitle', 'Request Quotes - Lessor')

@section('content')
    <div class="row no-gutters db-main-container">
        <!-- Sidebar Section - Same as Dashboard -->
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
                            <a class="nav-link {{ request()->routeIs('lessor.request-quotes') ? 'active' : '' }}"
                                href="{{ route('lessor.request-quotes') }}">
                                <i class="fas fa-fw fa-receipt mr-2"></i>Request Quotes
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
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('lessor.profile.show') ? 'active' : '' }}"
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
                <!-- Request Quotes Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="h4 font-weight-bold text-dark mb-1">Request Quotes</h2>
                                <p class="mb-0 text-muted">Manage all quote requests from potential clients</p>
                            </div>
                            <div class="db-date-display bg-white p-2 rounded shadow-sm">
                                <i class="far fa-calendar-alt mr-2 text-primary"></i>
                                <span id="current-date">{{ now()->format('l, F j, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Request Quotes Table -->
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                                <h6 class="m-0 font-weight-bold text-primary">All Quote Requests</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Date for Availability</th>
                                                <th>Message</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($quoteRequests as $request)
                                            <tr>
                                                <td class="align-middle">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ $request->user->image ? asset('storage/' . $request->user->image) : asset('assets/images/avatar-3.jpg') }}"
                                                             alt="{{ $request->user->name }}"
                                                             class="rounded-circle mr-2"
                                                             width="40">
                                                        <span>{{ $request->user->name }}</span>
                                                    </div>
                                                </td>
                                                <td class="align-middle"><a href="mailto:{{ $request->user->email }}" class="text-primary">{{ $request->user->email }}</a></td>
                                                <td class="align-middle">{{ $request->user->phone }}</td>
                                                <td class="align-middle">
                                                    {{ $request->availability_date ? \Carbon\Carbon::parse($request->availability_date)->format('M d, Y') : 'N/A' }}
                                                </td>
                                                <td class="align-middle">
                                                    <button class="btn btn-sm btn-outline-primary view-message"
                                                            data-toggle="modal"
                                                            data-target="#messageModal"
                                                            data-name="{{ $request->user->name }}"
                                                            data-email="{{ $request->user->email }}"
                                                            data-phone="{{ $request->user->phone }}"
                                                            data-date="{{ $request->availability_date ? \Carbon\Carbon::parse($request->availability_date)->format('M d, Y') : 'N/A' }}"
                                                            data-message="{{ $request->message }}">
                                                        <i class="fas fa-envelope-open-text mr-1"></i> View
                                                    </button>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                                type="button" id="dropdownMenuButton"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="#"><i class="fas fa-edit mr-2"></i>Edit</a>
                                                            <a class="dropdown-item" href="#"><i class="fas fa-trash mr-2"></i>Delete</a>
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

    <!-- Message Modal -->
    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">Quote Request Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <h6 class="font-weight-bold">Name:</h6>
                            <p id="modalName"></p>
                        </div>
                        <div class="col-md-4">
                            <h6 class="font-weight-bold">Email:</h6>
                            <p id="modalEmail"></p>
                        </div>
                        <div class="col-md-4">
                            <h6 class="font-weight-bold">Phone:</h6>
                            <p id="modalPhone"></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="font-weight-bold">Availability Date:</h6>
                            <p id="modalDate"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h6 class="font-weight-bold">Message:</h6>
                            <div class="card bg-light p-3">
                                <p id="modalMessage" class="mb-0"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Respond</button>
                </div>
            </div>
        </div>
    </div>
@endsection

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

    .db-date-display {
        font-size: 0.9rem;
        color: #6c757d;
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
    document.addEventListener('DOMContentLoaded', function() {
        // Update current date
        function updateCurrentDate() {
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const now = new Date();
            const currentDateElem = document.getElementById('current-date');
            if (currentDateElem) {
                currentDateElem.textContent = now.toLocaleDateString('en-US', options);
            }
        }

        updateCurrentDate();

        // Add active class to current nav item
        const currentPath = window.location.pathname;
        document.querySelectorAll('.db-sidebar-nav .nav-link').forEach(link => {
            if (link.href.includes(currentPath)) {
                link.classList.add('active');
            }
        });

        // Handle message modal
        document.querySelectorAll('.view-message').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const name = btn.getAttribute('data-name');
                const email = btn.getAttribute('data-email');
                const phone = btn.getAttribute('data-phone');
                const date = btn.getAttribute('data-date');
                const message = btn.getAttribute('data-message');

                const modalName = document.getElementById('modalName');
                const modalEmail = document.getElementById('modalEmail');
                const modalPhone = document.getElementById('modalPhone');
                const modalDate = document.getElementById('modalDate');
                const modalMessage = document.getElementById('modalMessage');

                if (modalName) modalName.textContent = name;
                if (modalEmail) modalEmail.textContent = email;
                if (modalPhone) modalPhone.textContent = phone;
                if (modalDate) modalDate.textContent = date;
                if (modalMessage) modalMessage.textContent = message;
            });
        });
    });
</script>
@endpush
