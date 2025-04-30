@extends('layouts.lessor')

@section('pageTitle', 'Request Quote')

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
                        <a class="nav-link {{ request()->routeIs('lessor.request-quotes') ? 'active' : '' }}" href="{{ route('lessor.request-quotes') }}">
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

    <!-- Content Section -->
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="db-pageheader mb-4">
                    <h2 class="h3 mb-0">Request Quote</h2>
                    <p class="db-pageheader-text">In commodo lorem ut erat sagittis variusm euismod lectus vehicula cursus est.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="table-responsive request-quote-table">
                        <table class="table second">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Date for availability</th>
                                    <th>Message</th>
                                    <th data-orderable="false">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($quoteRequests as $request)
                                <tr>
                                    <td><span>{{ $request->user->name }}</span></td>
                                    <td><a href="mailto:{{ $request->user->email }}" class="text-dark">{{ $request->user->email }}</a></td>
                                    <td><span>{{ $request->user->phone }}</span></td>
                                    <td><span>{{ $request->availability_date ?? 'Not Available' }}</span></td>
                                    <td>
                                        <a href="#!" class="request-quote-message" data-toggle="modal" data-target="#exampleModalLong"
                                           data-name="{{ $request->user->name }}"
                                           data-email="{{ $request->user->email }}"
                                           data-phone="{{ $request->user->phone }}"
                                           data-message="{{ $request->message }}">
                                            <i class="fas fa-envelope-open"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="request-quote-action">
                                            <div class="dropdown dropright">
                                                <a href="#" class="btn" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v text-dark"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <a class="dropdown-item" href="#">Edit Details</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
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

<!-- Modal -->
<div class="modal request-quote-modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-body-name mb-0" id="modal-name"></h4>
                <p class="modal-body-contact">
                    <span class="modal-body-contact-email" id="modal-email"></span>
                    <span class="modal-body-contact-number" id="modal-phone"></span>
                </p>
                <div class="modal-body-message">
                    <h5 class="modal-body-message-title">Message</h5>
                    <p class="modal-body-message-text" id="modal-message"></p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // تهيئة المودال عند النقر على الرسالة
    $('#exampleModalLong').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // زر الرسالة الذي تم النقر عليه
        var name = button.data('name'); // اسم المستخدم
        var email = button.data('email'); // بريد المستخدم
        var phone = button.data('phone'); // رقم هاتف المستخدم
        var message = button.data('message'); // الرسالة

        // تحديث محتويات المودال
        var modal = $(this);
        modal.find('#modal-name').text(name);
        modal.find('#modal-email').text(email);
        modal.find('#modal-phone').text(phone);
        modal.find('#modal-message').text(message);
    });
</script>
@endpush

@endsection
