<!DOCTYPE html>
<html>
<<<<<<< HEAD
@include('layouts.header') 
=======
@include('layouts.header')
>>>>>>> origin
@include('layouts.navbar')
<body>
<div class="container">
  @yield('content')
  </div>
  <script src="{{ asset('js/app.js') }}" type="text/js"></script>
@include('layouts.footer')
</body>
</html>
