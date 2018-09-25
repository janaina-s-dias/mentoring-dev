<!DOCTYPE html>
<html>
@include('header')
@include('navbar')
<body>
<div class="container">
  @yield('content')
  </div>
  <script src="{{ asset('js/app.js') }}" type="text/js"></script>
@include('footer')
</body>
</html>