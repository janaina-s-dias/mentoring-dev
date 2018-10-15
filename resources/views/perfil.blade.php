@extends('layouts.dashboardPerfil')
@section('page_heading','Perfil')
@section('section')
        
        <link rel="stylesheet" href="{{ asset("assets/stylesheets/stylesprofileuser.css") }}" type="text/css">

        <section class="astros">
     
        <header class="o-header">
        <img class="tumbnail" src="{{ asset("logos/avatar.png") }}"  alt="">
        </header>
        <header class="e-header">
        <div><h2>Nome</h2></div>
        <div><h2>Alguma coisa</h2></div>
        <div><h2>Alguma outra coisa</h2></div>
        </header>
        <aside class="o-aside">
        <div>
        <h2>ASSUNTOS</h2>
        <ul class="aki">
            <li>
                Assuntos....
            </li>
            <li>
                Assuntos....
            </li>
            <li>
                Assuntos....
            </li>
            <li>
                Assuntos....
            </li>

        </ul>
       </div>
       </aside>
       <main class="o-main">
       
       <div><h2>Conteúdo</h2></div>


       
       </main>


    </section>
            
@stop
