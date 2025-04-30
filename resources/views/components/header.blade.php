<header>
    <nav class="navbar navbar-expand-lg py-3 navbar-light bg-white shadow-sm">
        <div class="container-fluid">
            <a href="{{ url('/') }}">
                <img src="{{ asset('assets/images/spacely-logo.svg') }}" alt="Spacely Logo" class="navbar-brand-img">
            </a>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-bar top-bar mt-0"></span>
                <span class="icon-bar middle-bar"></span>
                <span class="icon-bar bottom-bar"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-lg-auto">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ url('renter/workspaces') }}">Listings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('renter.contact') }}">Contact</a>
                    </li>
                </ul>
                <div class="ml-lg-4 d-none d-lg-block">
                    @guest
                        <a href="{{ route('auth.login') }}" class="btn btn-outline-primary btn-lg mr-3">Login</a>
                        <a href="{{ route('workspaces.create') }}" class="btn btn-secondary btn-lg">List A Space</a>
                    @endguest
                    @auth
                        <div class="dropdown d-flex align-items-center">
                            <!-- Profile Picture -->
                            <button class="btn btn-link p-0" id="profileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('assets/images/default-avatar.png') }}" alt="Profile" class="rounded-circle" width="40" height="40">
                            </button>
                            <!-- Dropdown Menu -->
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                                {{-- <a class="dropdown-item" href="{{ route('profile.show') }}">View Profile</a> --}}
                                <a class="dropdown-item" href="#">View Profile</a>

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
                            </div>
                            <!-- Logout Form -->
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>
