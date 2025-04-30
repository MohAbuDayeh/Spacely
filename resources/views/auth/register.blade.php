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

    <title>Spacely | Register</title>
  </head>

  <body class="bg-light">
    <div class="min-vh-100 d-flex align-items-center bg-light">
      <div class="container">
        <div class="row">
          <div class="offset-lg-2 col-lg-8 col-md-12 col-12">
            <div class="card mb-3 shadow rounded-lg border-0">
              <div class="row no-gutters">
                <div class="col-md-7">
                  <div class="card-body p-7">
                    <div class="mb-4">
                      <h3>Register</h3>
                      <p>Register your account</p>
                    </div>
                    <!-- Start of Registration Form -->
                    <form method="POST" action="{{ route('auth.register') }}">
                      @csrf  <!-- CSRF Token for security -->

                      <div class="form-group">
                        <label for="name" class="sr-only">Name</label>
                        <input
                          type="text"
                          class="form-control"
                          id="name"
                          name="name"
                          placeholder="Name"
                          required=""
                          value="{{ old('name') }}"
                        />
                        @error('name')
                          <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="email" class="sr-only">Email</label>
                        <input
                          type="email"
                          class="form-control"
                          id="email"
                          name="email"
                          placeholder="Email"
                          required=""
                          value="{{ old('email') }}"
                        />
                        @error('email')
                          <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="phone" class="sr-only">Phone Number</label>
                        <input
                          type="text"
                          class="form-control"
                          id="phone"
                          name="phone"
                          placeholder="Phone Number"
                          required=""
                          value="{{ old('phone') }}"
                        />
                        @error('phone')
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
                            required=""
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

                      <div class="form-group">
                        <label for="password_confirmation" class="sr-only">Confirm Password</label>
                        <div class="input-group mb-3">
                          <input
                            id="password_confirmation"
                            type="password"
                            class="form-control border-right-0"
                            name="password_confirmation"
                            placeholder="Confirm Password"
                            aria-describedby="password_confirmation"
                            required=""
                          />

                        </div>

                      </div>

                      <button type="submit" class="btn btn-secondary">
                        Create an Account
                      </button>
                    </form>
                    <!-- End of Registration Form -->

                    <div class="mt-3 mb-3">
                      <div class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          class="custom-control-input"
                          id="termsandcondition"
                        />
                        <label class="custom-control-label" for="termsandcondition">
                          I accept <a href="#">privacy policy</a> and terms
                        </label>
                      </div>
                    </div>

                    <p class="mb-0">
                      Already have an account?
                      <a href="{{ route('auth.login') }}"> Log in</a>
                    </p>
                  </div>
                </div>

                <div class="col-md-5 d-none d-md-block"
                  style="background: linear-gradient(144.95deg, #fa2aa4 -26.22%, #2841f8 119.37%); border-radius: 0px 0.4rem 0.4rem 0px;">
                  <div class="d-flex align-items-center justify-content-center flex-column h-100 text-center px-4">
                    <h3 class="text-white">Glad to see you</h3>
                    <p class="text-white mb-0">
                      The registration page is a special page where users can create an account.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

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
