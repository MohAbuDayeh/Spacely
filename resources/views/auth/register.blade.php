<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="{{ asset('assets/libs/dropzone/dist/min/dropzone.min.css') }}">
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

                  <!-- Form Start -->
                  <form method="POST" action="{{ route('auth.register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="form-group">
                      <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}" required>
                      @error('name') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                      <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                      @error('email') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                    </div>

                    <!-- Phone -->
                    <div class="form-group">
                      <input type="text" name="phone" class="form-control" placeholder="Phone Number" value="{{ old('phone') }}">
                      @error('phone') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                      <div class="input-group mb-3">
                        <input type="password" name="password" id="password-field" class="form-control border-right-0" placeholder="Password" required>
                        <div class="input-group-append">
                          <span class="input-group-text bg-white border-left-0 rounded-right fas fa-eye showhidepassword toggle-password"></span>
                        </div>
                      </div>
                      @error('password') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                      <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn btn-secondary w-100">Create an Account</button>
                  </form>

                  <!-- Terms -->
                  <div class="mt-3 mb-3">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="termsandcondition">
                      <label class="custom-control-label" for="termsandcondition">
                        I accept <a href="#">privacy policy</a> and terms
                      </label>
                    </div>
                  </div>

                  <!-- Login -->
                  <p class="mb-0">
                    Already have an account? <a href="{{ route('auth.login') }}">Log in</a>
                  </p>
                </div>
              </div>

              <!-- Side Banner -->
              <div class="col-md-5 d-none d-md-block"
                   style="background: linear-gradient(144.95deg, #fa2aa4 -26.22%, #2841f8 119.37%); border-radius: 0px 0.4rem 0.4rem 0px;">
                <div class="d-flex align-items-center justify-content-center flex-column h-100 text-center px-4">
                  <h3 class="text-white">Glad to see you</h3>
                  <p class="text-white mb-0">The registration page is a special page where users can create an account.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- JS Validation (Front-end) -->
  <script>
    document.querySelector('form').addEventListener('submit', function(e) {
      let errors = [];

      const name = document.querySelector('input[name="name"]');
      const email = document.querySelector('input[name="email"]');
      const phone = document.querySelector('input[name="phone"]');
      const password = document.querySelector('input[name="password"]');
      const confirmPassword = document.querySelector('input[name="password_confirmation"]');

      document.querySelectorAll('.text-danger.front-error').forEach(el => el.remove());

      if (!name.value.trim()) errors.push({ field: name, message: 'Name is required' });
      if (!email.value.trim()) {
        errors.push({ field: email, message: 'Email is required' });
      } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
        errors.push({ field: email, message: 'Invalid email format' });
      }
      if (!phone.value.trim()) errors.push({ field: phone, message: 'Phone number is required' });
      if (!password.value) errors.push({ field: password, message: 'Password is required' });
      else if (password.value.length < 8) errors.push({ field: password, message: 'Password must be at least 8 characters' });
      if (password.value !== confirmPassword.value) errors.push({ field: confirmPassword, message: 'Password confirmation does not match' });

      if (errors.length > 0) {
        e.preventDefault();
        errors.forEach(error => {
          const div = document.createElement('div');
          div.className = 'text-danger mt-1 front-error';
          div.textContent = error.message;
          error.field.parentNode.appendChild(div);
        });
      }
    });

    document.querySelector('.toggle-password').addEventListener('click', function () {
      const input = document.getElementById('password-field');
      input.type = input.type === 'password' ? 'text' : 'password';
    });
  </script>

  <!-- Scripts -->
  <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/theme.min.js') }}"></script>
</body>
</html>
