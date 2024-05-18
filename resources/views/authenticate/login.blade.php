
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login Page</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css')}}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-social/bootstrap-social.css')}}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css')}}">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
</head>

<body>
  <div id="app" style="width: 100%">
    <!-- Session Status -->
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
    <section class="section  mt-4">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <form method="POST" action="{{ route('login.store') }}" class=" p-4 rounded-lg">
                @csrf
                <div class="card card-primary">
                    <div class="card-header text-center h2 d-flex justify-content-center align-content-center font-extrabold">Login</div>

                    <div class="card-body">
                        <form method="POST" action="#" class="needs-validation" novalidate="">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control block mt-1 w-full" name="email" value="{{ old('email') }}"  autofocus autocomplete="email" >
                            @if($errors->has('email'))
                              <div class="error text-danger">{{ $errors->first('email') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="d-block">
                                <label for="password" class="control-label">Password</label>
                            <div class="float-right">
                                <a href="{{ route('forget-pass.page') }}" class="text-small">
                                    Forgot Password?
                                </a>
                            </div>
                            </div>
                            <input id="password" class="form-control block mt-1 w-full" type="password" name="password"
                                 autocomplete="current-password">
                              @if($errors->has('password'))
                                <div class="error text-danger">{{ $errors->first('password') }}</div>
                              @endif
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                <label class="custom-control-label" for="remember-me">Remember Me</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                 Login
                            </button>
                        </div>
                        </form>
                    </div>
                    <div class="mb-2 text-muted text-center">
                        @if (Route::has('register.page'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register.page') }}">
                                {{ __('Dont have account, register?') }}
                            </a>
                        @endif
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

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="{{ asset('assets/js/scripts.js')}}"></script>
  <script src="{{ asset('assets/js/custom.js')}}"></script>
</body>
</html>



