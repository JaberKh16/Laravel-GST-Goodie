
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>GST Biiling Application</title>

  {{-- css files  --}}
  @include('includes.css-files')

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
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      
      {{-- top navbar section --}}
      @include('includes.topnavbar')

      {{-- leftbar section --}}
      @include('includes.leftnavbar')

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>
          {{-- box section --}}
          @yield('user-content')
          {{-- draft section --}}
        </section>
      </div>
      {{-- footer section --}}
        @include('includes.footer')
    </div>
  </div>
  {{-- script files --}}
   @include('includes.scripts')
</body>
</html>
