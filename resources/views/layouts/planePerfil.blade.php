<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="utf-8"/>

        @yield('title')

        <link rel="shortcut icon" href="{{ asset('logos/icone-azul.png') }}" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta content="" name="description"/>
        <meta content="" name="author"/>

        @yield('styles')
            <link href="{{ asset('DashboardPerfil/DashboardPerfil.css') }}" rel="stylesheet" type="text/css"/>

        @yield('scripts')

        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
		<link rel="stylesheet" href="{{ asset('assets/stylesheets/styles.css') }}" />
        <script src="{{asset('assets/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    </head>
<body>
	@yield('body')
</body>
</html>
