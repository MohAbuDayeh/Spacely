<header class="sticky-top">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('assets/images/spacely-logo.svg') }}" alt="Spacely" height="40">
            </a>

            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-bar top-bar"></span>
                <span class="icon-bar middle-bar"></span>
                <span class="icon-bar bottom-bar"></span>
            </button>

            <!-- Main Navigation -->
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item mx-lg-2">
                        <a class="nav-link px-3 py-2 {{ request()->is('/') ? 'active text-primary' : 'text-dark' }}" href="{{ url('/') }}">
                            Home
                        </a>
                    </li>
                    <li class="nav-item mx-lg-2">
                        <a class="nav-link px-3 py-2 {{ request()->is('renter/workspaces*') ? 'active text-primary' : 'text-dark' }}" href="{{ route('renter.workspaces.index') }}">
                            Workspaces
                        </a>
                    </li>
                    <li class="nav-item mx-lg-2">
                        <a class="nav-link px-3 py-2 {{ request()->is('contact*') ? 'active text-primary' : 'text-dark' }}" href="{{ route('renter.contact') }}">
                            Contact
                        </a>
                    </li>
                    <li class="nav-item mx-lg-2 d-lg-none">
                        @guest
                            <a class="nav-link px-3 py-2 text-dark" href="{{ route('auth.login') }}">Login</a>
                            <a class="btn btn-primary btn-block mt-2" href="{{ route('renter.workspaces.index') }}">List A Space</a>
                        @endguest
                    </li>
                </ul>

                <!-- Auth Links (Desktop) -->
                <div class="d-none d-lg-flex align-items-center">
                    @guest
                        <a href="{{ route('auth.login') }}" class="btn btn-outline-primary mr-3 px-4">Login</a>
                        <a href="{{ route('renter.workspaces.index') }}" class="btn btn-primary px-4">List A Space</a>
                    @else
                        <div class="dropdown ml-3">
                            <a href="#" class="dropdown-toggle d-flex align-items-center text-decoration-none" id="userDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                                <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('assets/images/profile.jpn.webp') }}"
                                     alt="{{ Auth::user()->name }}"
                                     class="rounded-circle mr-2"
                                     width="40"
                                     height="40">
                                <span class="text-dark">{{ Auth::user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow-sm" aria-labelledby="userDropdown">
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('renter.profile', auth()->id()) }}">
                                    <i class="far fa-user mr-2"></i> Profile
                                </a>
                                @if(auth()->user()->role === 'lessor')
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('lessor.dashboard') }}">
                                        <i class="fas fa-tachometer-alt mr-2"></i> Lessor Dashboard
                                    </a>
                                @endif
                                @if(auth()->user()->role === 'admin')
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-cog mr-2"></i> Admin Dashboard
                                    </a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>
</header>

<style>
    /* Navbar Toggle Animation */
    .navbar-toggler {
        border: none;
        padding: 0.5rem;
    }

    .navbar-toggler:focus {
        outline: none;
        box-shadow: none;
    }

    .icon-bar {
        display: block;
        width: 22px;
        height: 2px;
        background-color: #333;
        transition: all 0.2s;
        margin: 4px 0;
    }

    .navbar-toggler.collapsed .top-bar {
        transform: rotate(0);
    }

    .navbar-toggler.collapsed .middle-bar {
        opacity: 1;
    }

    .navbar-toggler.collapsed .bottom-bar {
        transform: rotate(0);
    }

    .navbar-toggler .top-bar {
        transform: rotate(45deg);
        transform-origin: 10% 10%;
    }

    .navbar-toggler .middle-bar {
        opacity: 0;
    }

    .navbar-toggler .bottom-bar {
        transform: rotate(-45deg);
        transform-origin: 10% 90%;
    }

    /* Active Nav Link */
    .nav-link.active {
        font-weight: 600;
        position: relative;
    }

    .nav-link.active:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 20px;
        height: 2px;
        background-color: var(--primary);
    }

    /* Dropdown Menu */
    .dropdown-menu {
        border: none;
        min-width: 200px;
    }

    .dropdown-item {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
    }
</style>
