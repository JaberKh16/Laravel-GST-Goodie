<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Register Page</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css')}}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('assets/modules/jquery-selectric/selectric.css')}}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css')}}">

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
</head>

<body>
  <div id="app">
    <section class="process-status">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if (session()->has('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                });
            </script>
        @elseif (session()->has('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}',
                });
            </script>
        @endif
    </section>
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <form method="POST" action="{{ route('register.store') }}">
                @csrf
                <div class="card card-primary">
                <div class="card-header d-flex justify-content-center align-items-center h2 font-extrabold text-underline">Register</div>

                <div class="card-body">
                    <form method="POST">
                    <div class="row">
                        <div class="form-group col-6">
                        <label for="fullname" value="__('Name')">Full Name</label>
                        <input id="fullname" class="form-control" type="text" name="fullname" value="{{ old('fullname') }}" autofocus autocomplete="fullname">
                        @if($errors->has('fullname'))
                              <div class="error text-danger">{{ $errors->first('fullname') }}</div>
                        @endif
                        </div>
                        <div class="form-group col-6">
                        <label ffor="username" value="__('UserName')">User Name</label>
                        <input  id="username" class="form-control" type="text" name="username" value="{{ old('username') }}" autofocus autocomplete="username"/>
                        @if($errors->has('username'))
                              <div class="error text-danger">{{ $errors->first('username') }}</div>
                        @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" value="__('Email')">Email</label>
                        <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" autocomplete="email">
                        @if($errors->has('email'))
                              <div class="error text-danger">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                        <label for="password" value="__('Password')" class="d-block">Password</label>
                        <input id="password" class="form-control"
                                type="password"
                                name="password"
                                autocomplete="new-password" />
                        @if($errors->has('password'))
                              <div class="error text-danger">{{ $errors->first('password') }}</div>
                        @endif
                        </div>
                        <div class="form-group col-6">
                        <label for="password_confirmation" value="__('Confirm Password')" class="d-block">Password Confirmation</label>
                        <input id="password_confirmation" class="form-control"
                                type="password"
                                name="password_confirmation" autocomplete="new-password" />
                        @if($errors->has('password_confirmation'))
                              <div class="error text-danger">{{ $errors->first('password_confirmation') }}</div>
                        @endif
                        </div>
                    </div>

                
                    <div class="row">
                        <div class="form-group col-12">
                        <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Role Type') }}</label>
                            <select class="form-control selectric" name="role_type">
                                <option value="" selected disabled>Please select</option>
                                <option value="Vendor">Vendor</option>
                                <option value="Admin">Admin</option>
                                <option value="Employee">Employee</option>
                                <option value="Client">Client</option>
                            </select>
                        </div>
                        @if($errors->has('role_type'))
                              <div class="error text-danger ml-3">{{ $errors->first('role_type') }}</div>
                        @endif
                    </div>
                        
                    <div class="form-group d-flex ailign-items-center justify-content-between">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="agree_terms" class="custom-control-input" id="agree_terms">
                            <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                            @if($errors->has('agree_terms'))
                              <div class="error text-danger ml-3">{{ $errors->first('agree_terms') }}</div>
                            @endif
                        </div>
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login.page') }}">
                            {{ __('Already registered?') }}
                        </a>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Register
                        </button>
                    </div>
                    </form>
                </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('assets/modules/jquery.min.js')}}"></script>
  <script src="{{ asset('assets/modules/popper.js')}}"></script>
  <script src="{{ asset('assets/modules/tooltip.js')}}"></script>
  <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
  <script src="{{ asset('assets/modules/moment.min.js')}}"></script>
  <script src="{{ asset('assets/js/stisla.js')}}"></script>
  
  <!-- JS Libraies -->
  <script src="{{ asset('assets/modules/jquery-pwstrength/jquery.pwstrength.min.js')}}"></script>
  <script src="{{ asset('assets/modules/jquery-selectric/jquery.selectric.min.js')}}"></script>

  <!-- Page Specific JS File -->
  <script src="{{ asset('assets/js/page/auth-register.js')}}"></script>
  
  <!-- Template JS File -->
  <script src="{{ asset('assets/js/scripts.js')}}"></script>
  <script src="{{ asset('assets/js/custom.js')}}"></script>
</body>
</html>
