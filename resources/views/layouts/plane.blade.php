<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
	<meta charset="utf-8"/>
	<title>Mentoring</title>
	<link rel="shortcut icon" href="{{ asset("logos/icone-azul.png") }}" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta content="" name="description"/>
	<meta content="" name="author"/>
        <script src="{{ asset("assets/scripts/frontend.js") }}" type="text/javascript"></script>
        <script src="{{ asset('DataTables/datatables.min.js') }}" type="text/javascript"></script>
        <link href="{{ asset('DataTables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" href="{{ asset("assets/stylesheets/styles.css") }}" />
<style rel="stylesheet">
a:hover {
    background-color: lightgreen;
}
</style>	
</head>
<body>
	@yield('body')
</body>
</html>