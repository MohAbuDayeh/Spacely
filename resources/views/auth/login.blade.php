<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Libs CSS -->
    <link rel="stylesheet" href="{{ asset('assets/libs/dropzone/dist/min/dropzone.min.css') }}">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">

    <title>Spacely | Login</title>
  </head>

  <body class="bg-light">
    <div class="min-vh-100 d-flex align-items-center">
      <div class="container">
        <div class="row">
          <div class="offset-lg-2 col-lg-8 col-md-12 col-12">
            <div class="card mb-3 shadow rounded-lg border-0">
              <div class="row no-gutters">
                <div class="col-md-7">
                  <div class="card-body p-7">
                    <div class="mb-4">
                      <h3>Login</h3>
                      <p>Login to your account</p>
                    </div>
                    <!-- Start of the Login Form -->
                    <form method="POST" action="{{ route('auth.login') }}">
                      @csrf  <!-- CSRF Token to protect against CSRF attacks -->
                      <div class="form-group">
                        <label for="email" class="sr-only">Email</label>
                        <input
                          type="email"
                          class="form-control"
                          id="email"
                          name="email"
                          value="{{ old('email') }}"
                          placeholder="Email"
                          required=""
                        />
                        @error('email')
                          <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="password-field" class="sr-only">Password</label>
                        <div class="input-group mb-3">
                          <input
                            id="password-field"
                            type="password"
                            class="form-control border-right-0"
                            name="password"
                            placeholder="*************"
                            aria-describedby="password-field"
                            required
                          />
                          <div class="input-group-append">
                            <span
                              class="input-group-text bg-white border-left-0 rounded-right fas fa-eye showhidepassword"
                              id="password-field"
                              toggle="#password-field"
                            ></span>
                          </div>
                        </div>
                        @error('password')
                          <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-secondary">
                          Sign In
                        </button>
                        <a href="{{ route('password.request') }}" class="font-14">Forgot Password?</a>
                      </div>
                    </form>
                    <!-- End of the Login Form -->

                    <div class="mt-3 mb-3">
                      <div class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          class="custom-control-input"
                          id="rememberme"
                          name="remember"
                        />
                        <label class="custom-control-label" for="rememberme">
                          Remember Me
                        </label>
                      </div>
                    </div>

                    <p class="mb-0">
                      Don’t have a Spacely account?
                      <a href="{{ route('auth.register') }}">Create Account</a>
                    </p>
                  </div>
                </div>

                <!-- Right Side Image and Welcome Text -->
                <div
                  class="col-md-5 d-none d-md-block"
                  style="background: linear-gradient(144.95deg, #fa2aa4 -26.22%, #2841f8 119.37%); border-radius: 0px 0.4rem 0.4rem 0px;"
                >
                  <div class="d-flex align-items-center justify-content-center flex-column h-100 text-center px-4">
                    <h3 class="text-white">Welcome Back!</h3>
                    <p class="text-white mb-0">
                      A user can input the username and the password together to log in.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ============================================================== -->
    <!-- Libs JS -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-raty-js/lib/jquery.raty.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/dataTables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery.easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/libs/prismjs/prism.js') }}"></script>
    <script src="{{ asset('assets/libs/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/libs/slick-carousel/slick/slick.min.js') }}"></script>
    <script src="{{ asset('assets/libs/dropzone/dist/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-mask-plugin/dist/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('assets/libs/leaflet/dist/leaflet.js') }}"></script>

    <!-- Theme JS -->
    <script src="{{ asset('assets/js/theme.min.js') }}"></script>
  </body>
</html>
