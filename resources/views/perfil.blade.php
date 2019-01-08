@extends('layouts.dashboardPerfil')

@section('titlePage')

        <title>Perfil - Mentoring</title>

@stop

@section('stylesPage')

        <link href="{{ asset('DashboardPerfil/DashboardPerfil.css') }}" rel="stylesheet" type="text/css"/>

@stop

@section('scriptsPage')

        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

@stop


@section('section')
<script type="text/javascript">
    $(document).ready(function(){
       $.get("{{route('usersubject.show', Auth::user()->user_id)}}", function(dados)
       {
           var option = '<br>';
           if(dados.length > 0){
            $.each(dados, function(i, linha)
            {
                option+= "<h5 style='text-align: right'>"+linha.assunto+"</h5>";
            });
            $("#assuntos").html(option).show();
           }
       }, 'json');
    });
</script>

        <link rel="stylesheet" href="{{ asset('assets/stylesheets/stylesprofileuser.css') }}" type="text/css">

        <section class="astros">

        <header class="o-header">
            <img class="tumbnail" src="{{ asset('logos/icone-azul.png') }}">
            <!-- src="{{ asset("logos/avatar.png") }}"  alt=""> -->
        </header>
        <header class="e-header">
            <div><h2>{{Auth::user()->user_nome}}</h2></div>
            <div><h4>@if(Auth::user()->user_role == 2) {{"Mentor"}}
                     @elseif(Auth::user()->user_role == 1) {{"Mentorado"}}
                     @elseif(Auth::user()->user_role == 3) {{"Moderador"}}
                     @elseif(Auth::user()->user_role == 4) {{"Administrador"}}
                     @elseif(Auth::user()->user_role == 5) {{"Administrador"}}
                     @endif
                </h4></div>
            <div><h4>Seja bem vindo</h4></div>
        </header>
        <div class="o-aside">
            <div>
                <h2>Assuntos</h2>
                    <div id="assuntos" class="aki">

                    </div>
            </div>
       </div>

       <div class="o-main">

            <div><h2>Conexões</h2></div>

       </div>


    </section>

@stop
