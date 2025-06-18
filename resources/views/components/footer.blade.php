<footer class="footer bg-dark text-white pt-8 pb-4">
    <div class="container">
        <div class="row">
            <!-- Column 1: Logo and Info -->
            <div class="col-lg-5 col-md-6 mb-5 mb-lg-0">
                <div class="footer-widget">
                    <div class="mb-4">
                        <img src="{{ asset('assets/images/spacely-logo-white.svg') }}" alt="Spacely Logo" width="160">
                    </div>
                    <p class="mb-4 text-muted">
                        The leading office space marketplace in Jordan. Find and list coworking spaces, private offices, and meeting rooms.
                    </p>
                    <div class="mb-4">
                        <p class="mb-2">
                            <i class="fas fa-phone-alt text-primary me-2"></i>
                            <span class="text-white">0797942398</span>
                        </p>
                        <p class="mb-0">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                            <span class="text-muted">Amman, Jordan</span>
                        </p>
                    </div>
                    <div class="social-links mt-4">
                        <a href="https://www.linkedin.com/in/mohammad-abu-dayeh/" class="text-white me-3" title="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://github.com/MohAbuDayeh" class="text-white" title="GitHub">
                            <i class="fab fa-github"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Column 2: Quick Links -->
            <div class="col-lg-3 col-md-4 col-sm-6 mb-5 mb-md-0">
                <div class="footer-widget">
                    <h3 class="h5 text-white mb-4">Quick Links</h3>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="{{ url('/') }}" class="text-muted hover-text-white d-flex align-items-center">
                                <i class="fas fa-home text-primary me-2" style="width: 20px;"></i> Home
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('renter.workspaces.index') }}" class="text-muted hover-text-white d-flex align-items-center">
                                <i class="fas fa-building text-primary me-2" style="width: 20px;"></i> Workspaces
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('renter.contact') }}" class="text-muted hover-text-white d-flex align-items-center">
                                <i class="fas fa-envelope text-primary me-2" style="width: 20px;"></i> Contact
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('auth.login') }}" class="text-muted hover-text-white d-flex align-items-center">
                                <i class="fas fa-sign-in-alt text-primary me-2" style="width: 20px;"></i> Login
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('auth.register') }}" class="text-muted hover-text-white d-flex align-items-center">
                                <i class="fas fa-user-plus text-primary me-2" style="width: 20px;"></i> Register
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Column 3: Space Types -->
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="footer-widget">
                    <h3 class="h5 text-white mb-4">Space Types</h3>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="{{ route('renter.workspaces.index') }}?type=coworking" class="text-muted hover-text-white d-flex align-items-center">
                                <i class="fas fa-users text-primary me-2" style="width: 20px;"></i> Coworking Space
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('renter.workspaces.index') }}?type=private" class="text-muted hover-text-white d-flex align-items-center">
                                <i class="fas fa-door-closed text-primary me-2" style="width: 20px;"></i> Private Offices
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('renter.workspaces.index') }}?type=meeting" class="text-muted hover-text-white d-flex align-items-center">
                                <i class="fas fa-handshake text-primary me-2" style="width: 20px;"></i> Meeting Space
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Copyright Section -->
        <div class="border-top border-secondary pt-4 mt-5">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <p class="small text-muted mb-0">
                        &copy; {{ date('Y') }} Spacely. All rights reserved.
                    </p>
                </div>

            </div>
        </div>
    </div>
</footer>

<style>
    .footer {
        background-color: #1a1d23;
        position: relative;
        z-index: 1;
    }

    .hover-text-white:hover {
        color: #fff !important;
        text-decoration: none;
    }

    .social-links a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        transition: all 0.3s ease;
        font-size: 16px;
    }

    .social-links a:hover {
        background: var(--primary);
        transform: translateY(-3px);
        color: #fff !important;
    }

    .footer-widget h3 {
        position: relative;
        padding-bottom: 12px;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .footer-widget h3:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 2px;
        background: var(--primary);
    }

    .list-unstyled li {
        margin-bottom: 10px;
        transition: transform 0.2s ease;
    }

    .list-unstyled li:hover {
        transform: translateX(5px);
    }

    .list-unstyled a {
        transition: color 0.2s ease;
    }

    .border-secondary {
        border-color: rgba(255,255,255,0.1) !important;
    }
</style>
