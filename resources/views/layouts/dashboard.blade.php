@extends('layouts.plane')
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
                                    "<a class='text-center'><em>Nenhuma solicitação encontrada</em></a>"+
                                "</li>";
                        $("#solicitacao").append(text);
                }
                $("#solicitacao").append("<li class='divider'></li><li><a class='text-center' href=''><strong>See All Alerts</strong><i class='fa fa-angle-right'></i></a></li>");
                
            }
        }); 
    });
</script>
<style>
.badge-notify{
   color:white;
   position:relative;
   border-radius: 50px;
   top: -6px;
   left: -6px;
}
</style>
    <?php $user = Auth::user(); ?>
<div id="wrapper">
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: rgb(0,176,176);">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url ('/') }}" style="color:white;">Mentoring</a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            {{--<li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-comment fa-fw"  style="color:black;"></i>  <i class="fa fa-caret-down"  style="color:black;"></i>
                </a>
                <ul class="dropdown-menu dropdown-messages">
                    <li>
                        <a href="#">
                            <div>
                                <strong></strong>
                                <span class="pull-right text-muted">
                                    <em>Hora/Dia</em>
                                </span>
                            </div>
                            <div>Conteudo da Mensagem</div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>Read All Messages</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-tasks fa-fw"  style="color:black;"></i>  <i class="fa fa-caret-down"  style="color:black;"></i>
                </a>
                <ul class="dropdown-menu dropdown-tasks">
                    <li>
                        <a href="#">
                            <div>
                                <p>
                                    <strong>Task 1</strong>
                                    <span class="pull-right text-muted">40% Complete</span>
                                </p>
                                <div>
                                    @include('widgets.progress', array('animated'=> true, 'class'=>'success', 'value'=>'40'))
                                    <span class="sr-only">40% Complete (success)</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>See All Tasks</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </li>--}}
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-fw" id="notific" style="color:black;"></i>  <i class="fa fa-caret-down"  style="color:black;"></i>
                </a>
                <ul id="solicitacao" class="dropdown-menu dropdown-alerts">
                    
                    
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw" style="color:black;"></i><i class="fa fa-caret-down" style="color:black;"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="{{ route('perfil')}}"><i class="fa fa-user fa-fw"></i> Perfil de Usuario</a></li>
                    @if($user->user_role > 2)
                        <li><a href="{{ url('admin')}}"><i class="fa fa-wrench fa-fw"></i> Area Administrativa</a></li>
                    @endif
                    <li class="divider"></li>
                    <li><a href="{{ route ('sair') }}"><i class="fa fa-sign-out fa-fw"></i> Sair</a></li>
                </ul>
            </li>
        </ul>
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </li>
                    <li {{ (Request::is('') ? 'class="active"' : '') }}>
                        <a href="{{ url ('/') }}"><i class="fa fa-home fa-fw"></i> Paginal Inicial</a>
                    </li>
                    <li {{ (Request::is('*conexoes') ? 'class="active"' : '') }}>
                            <a href="{{ url ('conexoes') }}"><i class="fa fa-eye fa-fw"></i>Visualizar Conexões</a>
                    </li>
                     @if($user->user_role > 1 && $user->user_knowledge)
                    <li {{ (Request::is('*solicitacoes') ? 'class="active"' : '') }}>
                            <a href="{{ url ('solicitacoes') }}"><i class="fa fa-eye fa-fw"></i>Visualizar Solicitações</a>
                    </li>
                    @endif
                    <li {{ (Request::is('*mentores') ? 'class="active"' : '') }}>
                            <a href="{{ url ('mentores') }}"><i class="fa fa-list fa-fw"></i>Listar Mentores</a>
                    </li>
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
    </nav>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">@yield('page_heading')</h1>
            </div>
        </div>
	<div class="row">  
            @yield('section')
        </div>
    </div>
</div>
@stop

