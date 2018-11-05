@extends('layouts.dashboardPerfil') 

@section('titlePage')
        
        <title>Ver Conteúdo - Mentoring</title>

@stop  

@section('stylesPage')
        
        <link href="{{ asset('DataTables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="{{ asset("assets/stylesheets/styles.css") }}" />
        <link href="{{ asset('DashboardPerfil/DashboardPerfil.css') }}" rel="stylesheet" type="text/css"/>

@stop 

@section('scriptsPage')
    
        <script src="{{ asset("assets/scripts/frontend.js") }}" type="text/javascript"></script>
        <script src="{{ asset('DataTables/datatables.min.js') }}" type="text/javascript"></script> 
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    
@stop


@section('section')



<center><h2>{{$conteudo->content_title}}</h2></center>

<small class="col col-sm-offset-9">Mentor: {{$conteudo->user_nome}} Assunto: {{$conteudo->subject_name}}</small>

<br/>
<br/>
<br/>

{!!$conteudo->content_content!!}




@stop
