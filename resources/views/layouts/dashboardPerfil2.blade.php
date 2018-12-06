@extends('layouts.planePerfil')

@section('title')

   @yield('titlePage')

@stop

@section('styles')

   @yield('stylesPage')

@stop

@section('scripts')

   @yield('scriptsPage')

@stop

@section('body')

<div class="container-ce">
    <?php $user = Auth::user(); ?>
    <div class="header-ce">
        <i class="dropdown-menu">
           <img class="header-img" src="{{ asset('img/ment.png') }}">
        </i>
        <div class="dropdown-content" id="dropdown-content">
                 <a href="{{ route('perfil')}}">Perfil</a>
                 <a href="{{ route ('sair') }}">Sair</a>
        </div>
    </div>

    <div class="sidebar-ce">
        <div class="logo-ce">
            <a href="{{ url ('/') }}">
               <img src="{{ asset("img/mentoring-1.png") }}" alt="Mentoring">
            </a>
        </div>

        <div class="photo-ce">

        <div class="photo-img-ce">
            <a href="#">
                <img src="{{ asset("img/avatar.png") }}" alt="Avatar">
            </a>
        </div>

        <div class="photo-ce-role">

        <h1>{{Auth::user()->user_nome}}</h1>
        <h2> @if(Auth::user()->user_role == 2) {{"Mentor"}}
             @elseif(Auth::user()->user_role == 1) {{"Mentorado"}}
             @elseif(Auth::user()->user_role == 3) {{"Moderador"}}
             @elseif(Auth::user()->user_role == 4) {{"Administrador"}}
             @elseif(Auth::user()->user_role == 5) {{"Administrador"}}
             @endif
        </h2>
        </div>
        </div>

        <div class="list-ce">
            <ul class="navlist-ce">
                <li {{ (Request::is('') ? 'class="active"' : '') }}><a href="{{ url ('/') }}">Página Inicial</a></li>
                <li {{ (Request::is('*perfil') ? 'class="active"' : '') }}><a href="{{ url ('perfil') }}">Perfil</a></li>
                <li {{ (Request::is('*cadastroAssunto') ? 'class="active"' : '') }}><a href="{{ url ('cadastroAssunto') }}">Cadastrar Assunto</a></li>
                @if(Auth::user()->user_role >= 2)
                    <li {{ (Request::is('*Mentoria_no_assunto') ? 'class="active"' : '') }}>
                        <a href="{{ url ('Mentoria_no_assunto') }}">Mentoria por Assunto</a>
                    </li>
                @endif
                <li {{ (Request::is('*cadastroContato') ? 'class="active"' : '') }}><a href="{{ url ('cadastroContato') }}">Cadastrar Contato</a></li>
                <li {{ (Request::is('*meusContatos') ? 'class="active"' : '') }}><a href="{{ url ('meusContatos') }}">Meus Contatos</a></li>
                <li {{ (Request::is('*alterarPerfil') ? 'class="active"' : '') }}><a href="{{ url ('alterarPerfil') }}">Alterar Perfil</a></li>
                <li {{ (Request::is('*alterarSenha') ? 'class="active"' : '') }}><a href="{{ url ('alterarSenha') }}">Alterar Senha</a></li>
                <li {{ (Request::is('*conteudo') ? 'class="active"' : '') }}><a href="{{ url ('conteudo') }}">Cadastrar Conteúdo</a></li>
                @if($user->user_role > 2)
                        <li {{ (Request::is('*admin') ? 'class="active"' : '') }}>
                            <a href="{{ url ('admin') }}">Area Administrativa</a>
                        </li>
                @endif
            </ul>
        </div>

    </div>

    <div class="content-ce">

           @yield('section')

    </div>
</div>

<script type="text/javascript">

    $(document).ready(function(){

         $('.dropdown-menu').click(function(){

                 $('.dropdown-content').toggleClass('active');

         })
    });

    $(document).mouseup(function (e)
    {
    var container = $('.dropdown-content');

    if (!container.is(e.target) &&
        container.has(e.target).length === 0)
    {
        $('.dropdown-content').removeClass('active');
    }
    });


</script>

@stop

