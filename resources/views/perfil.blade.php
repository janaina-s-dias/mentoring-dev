@extends('layouts.dashboardPerfil')
@section('page_heading','Perfil')
@section('section')       
<script type="text/javascript">
    $(document).ready(function(){
       $.get("{{route('usersubject.show', Auth::user()->user_id)}}", function(dados)
       {
           var option = '';
           if(dados.length > 0){
            $.each(dados, function(i, linha)
            {
                option+= "<li>"+linha.assunto+"</li>";
            });
            $("#assuntos").html(option).show();
           }
       }, 'json'); 
    });
</script>
        <link rel="stylesheet" href="{{ asset("assets/stylesheets/stylesprofileuser.css") }}" type="text/css">

        <section class="astros">
     
        <header class="o-header">
            <img class="tumbnail" src="{{ asset("logos/icone-azul.png") }}">
            <!-- src="{{ asset("logos/avatar.png") }}"  alt=""> -->
        </header>
        <header class="e-header">
            <div><h2>{{Auth::user()->user_nome}}</h2></div>
            <div><h4>{{(Auth::user()->user_knowledge)? "Mentor" : (Auth::user()->user_role < 3) ? "Mentorado" : (Auth::user()->user_role == 5) ? "Desenvolvedor" : "Administrador"}}</h4></div>
            <div><h4>Seja bem vindo</h4></div>
        </header>
        <div class="o-aside">
            <div>
                <h2>Assuntos</h2>
                    <ul id="assuntos" class="aki">
                        
                    </ul>
            </div>
       </div>

       <div class="o-main">
       
            <div><h2>Conexões</h2></div>
      
       </div>


    </section>
            
@stop
