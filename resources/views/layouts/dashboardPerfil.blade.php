@extends('layouts.plane')

@section('body')
<div id="wrapper">
<?php $user = Auth::user(); ?>
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: rgb(0,176,176);">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url ('/') }}" style="color:white;">Mentoring</a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-comment fa-fw" style="color:black;"></i>  <i class="fa fa-caret-down" style="color:black;"></i>
                </a>
                <ul class="dropdown-menu dropdown-messages">
                    <li>
                        <a href="#">
                            <div>
                                <strong>{{$user->user_nome }}</strong>
                                <span class="pull-right text-muted">
                                    <em>Yesterday</em>
                                </span>
                            </div>
                            <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
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
                    <i class="fa fa-tasks fa-fw" style="color:black;"></i>  <i class="fa fa-caret-down" style="color:black;"></i>
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
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-bell fa-fw" style="color:black;"></i>  <i class="fa fa-caret-down" style="color:black;"></i>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-comment fa-fw"></i> New Comment
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw" style="color:black;"></i><i class="fa fa-caret-down" style="color:black;"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="{{ route('perfil')}}"><i class="fa fa-user fa-fw"></i> Perfil do Usuário</a></li>
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
                            <input type="text" name="search" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" id="btnSearch" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </li>
                    <li {{ (Request::is('') ? 'class="active"' : '') }}>
                        <a href="{{ url ('/') }}"><i class="fa fa-home fa-fw"></i> Paginal Inicial</a>
                    </li>
                    <li {{ (Request::is('*cadastroAssunto') ? 'class="active"' : '') }}>
                        <a href="{{ url ('cadastroAssunto') }}"><i class="fa fa-trophy fa-fw"></i> Cadastrar Assunto</a>
                    </li>
                    @if(Auth::user()->user_role >= 2)
                    <li {{ (Request::is('*Mentoria_no_assunto') ? 'class="active"' : '') }}>
                        <a href="{{ url ('Mentoria_no_assunto') }}"><i class="fa fa-edit fa-fw"></i> Mentoria por Assunto</a>
                    </li>
                    @endif
                    <li {{ (Request::is('*cadastroContato') ? 'class="active"' : '') }}>
                        <a href="{{ url ('cadastroContato') }}"><i class="fa fa-users fa-fw"></i> Cadastrar Contato</a>
                    </li>
                    <li {{ (Request::is('*meusContatos') ? 'class="active"' : '') }}>
                        <a href="{{ url ('meusContatos') }}"><i class="fa fa-list fa-fw"></i> Meus Contatos</a>
                    </li>
                    <li {{ (Request::is('*alterarPerfil') ? 'class="active"' : '') }}>
                        <a href="{{ url ('alterarPerfil') }}"><i class="fa fa-edit fa-fw"></i> Alterar Perfil</a>
                    </li>
                    <li {{ (Request::is('*alterarSenha') ? 'class="active"' : '') }}>
                        <a href="{{ url ('alterarSenha') }}"><i class="fa fa-lock fa-fw"></i> Alterar Senha</a>
                    </li>
                    <li {{ (Request::is('*conteudo') ? 'class="active"' : '') }}>
                            <a href="{{ url ('conteudo') }}"><i class="fa fa-plus fa-fw"></i>Cadastrar Conteudo</a>
                    </li>
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

