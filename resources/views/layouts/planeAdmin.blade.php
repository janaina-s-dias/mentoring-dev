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

            <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
            <script src="{{ asset('DataTables/datatables.min.js') }}" type="text/javascript"></script>
            <link href="{{ asset('DataTables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
            <link rel="stylesheet" href="{{ asset('assets/stylesheets/styles.css') }}" />

        @yield('styles')
        @yield('scripts')
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
        <link href="{{ asset('DashboardPerfil/DashboardPerfil.css') }}" rel="stylesheet" type="text/css"/>

    </head>
<body>
	@yield('body')
</body>
</html>
