@extends('layouts.dashboardPerfil')
@section('page_heading','Perfil')
@section('section')
<?php $user = Session::get('user'); ?>        
        <link rel="stylesheet" href="{{ asset("assets/stylesheets/stylesprofileuser.css") }}" type="text/css">

        <section class="astros">
     
        <header class="o-header">
        <img class="tumbnail" src="{{ asset("logos/avatar.png") }}"  alt="">
        </header>
        <header class="e-header">
        <div><h2>{{$user->user_nome}}</h2></div>
        <div><h4>Alguma coisa</h4></div>
        <div><h4>Alguma outra coisa</h4></div>
        </header>
        <aside class="o-aside">
        <div>
        <h2>Assuntos</h2>
        <ul class="aki">
        <?php // foreach ?>
            <li>
                Assuntos....
            </li>
        </ul>
       </div>
       </aside>
       <main class="o-main">
       
       <div><h2>Conexões</h2></div>
      
       </main>


    </section>
            
@stop
