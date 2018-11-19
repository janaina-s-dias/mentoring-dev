@extends('layouts.plane')

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

<script type="text/javascript">
    $(document).ready(function(){
        var text = "";
        
        $.ajax({
            url: "{{route('notificacao.solicitacao')}}",
            dataType: 'json',
            success: function(data)
            {
                if(data.length > 0)
                {
                    $.each(data, function(i, obj)
                    {
                        text += "<li><a href=''><div><strong>"+obj.nomeMentorado+"</strong><span class='pull-right text-muted'>"+
                                "<em>"+obj.dia+" "+obj.hora+"</em></span></div><div>"+obj.assunto+"</div></a></li>";
                        $("#solicitacao").append(text);
                    });
                    $("#notific").append("<span class='badge-notify'>"+data.length+"</span>");
                }
                else
                {
                    text += "<li>"+ 
                                    "<a><em>Nenhuma solicitação encontrada</em></a>"+
                                "</li>";
                        $("#solicitacao").append(text);
                }
                $("#solicitacao").append("<li class='divider'></li><li><a href='{{ url ('solicitacoes') }}'><strong>Ver todas solicitações</strong></a></li>");
                
            }
        }); 
    });
</script>
<style>
.badge-notify{
   padding: 3px;
   font-size: 10px; 
   background: red;
   color: white;
   position: absolute;
   border-radius: 50px;
   top: -6px;
   left: 12px;
}
</style>
<?php $user = Auth::user(); ?>
<div class="container-ce">
    <div class="header-ce">

        <div class="menu_btn">
            <input type="checkbox" id="check">
            <label for="check"></label>
            <span></span>
        </div>

        <ul class="header-ce-right">
            <li class="header-ce-icon">
                <a class="fi a-icon" id="notific">
                <i class="fa fa-bell fa-fw"></i>
                </a>
                <ul class="dropdown-s dropdown-solicitation" id="solicitacao">
                    <li><a><em>Nenhuma solicitação encontrada</em></a></li>
                    <li class="divider"></li>
                    <li><a><strong>Ver todas as solicitações</strong></a></li>
                </ul>
            </li>
            <li class="header-ce-icon">
                <a class="fe a-icon">
                    <i class="fa fa-user fa-fw"></i>
                </a>
                <ul class="dropdown-s dropdown-user">
                    <li><a href="{{ route('perfil')}}"><i class="fa fa-user fa-fw"></i>Perfil do Usuário</a></li>
                    @if($user->user_role > 2)
                    <li><a href="{{ url('admin')}}"><i class="fa fa-wrench fa-fw"></i>Área Administrativa</a></li>
                    @endif
                    <li class="divider"></li>
                    <li><a href="{{ route ('sair') }}"><i class="fa fa-sign-out-alt fa-fw"></i>Sair</a></li>
                </ul> 
            </li>               
        </ul>

    </div>  

    <div class="sidebar-ce">

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
                <li {{ (Request::is('') ? 'class="active"' : '') }}><a href="{{ url ('/') }}"><i class="fa fa-home fa-fw"></i>Página Inicial</a></li>
                <li {{ (Request::is('*conexoes') ? 'class="active"' : '') }}><a href="{{ url ('conexoes') }}"><i class="fa fa-eye fa-fw"></i>Visualizar Conexões</a></li>
                @if($user->user_role > 1 && $user->user_knowledge)
                    <li {{ (Request::is('*solicitacoes') ? 'class="active"' : '') }}>
                            <a href="{{ url ('solicitacoes') }}"><i class="fa fa-eye fa-fw"></i>Visualizar Solicitações</a>
                    </li>
                @endif
                <li {{ (Request::is('*mentores') ? 'class="active"' : '') }}><a href="{{ url ('mentores') }}"><i class="fa fa-eye fa-fw"></i>Listar Mentores</a></li>
                @if($user->user_role > 1 && $user->user_knowledge)
                    <li {{ (Request::is('*mentorias') ? 'class="active"' : '') }}>
                            <a href="{{ url ('mentorias') }}"><i class="fa fa-user fa-fw"></i>Minhas Mentorias</a>
                    </li>
                @endif
                @if($user->user_role > 2)
                    <li {{ (Request::is('*admin') ? 'class="active"' : '') }}>
                            <a href="{{ url ('admin') }}"><i class="fa fa-wrench fa-fw"></i>Area Administrativa</a>
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

    $('.fi').click(function(){
            $('.dropdown-solicitation').toggleClass('open', 500);
    });
    $('.fe').click(function(){
            $('.dropdown-user').toggleClass('open-user');
    });
    $('#check').click(function(){
            $('.sidebar-ce').toggleClass('open-sidebar');
    });

    $(document).click(function(e) {
            $('.header-ce-icon')
            .not($('.header-ce-icon').has($(e.target)))
                .children('.dropdown-s').removeClass('open');

            $('.header-ce-icon')
            .not($('.header-ce-icon').has($(e.target)))
                .children('.dropdown-s').removeClass('open-user');    
    });

});       


</script>

@stop

