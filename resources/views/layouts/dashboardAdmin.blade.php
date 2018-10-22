@extends('layouts.plane')

@section('body')
<div id="wrapper">
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url ('/') }}">Mentoring</a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-comment fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-messages">
                    <li>
                        <a href="#">
                            <div>
                                <strong>John Smith</strong>
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
                    <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
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
                    <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
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
                    <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="{{ url ('perfil')}}"><i class="fa fa-user fa-fw"></i> Perfil de Usuario</a></li>
                    <li><a href="{{ url ('admin') }}"><i class="fa fa-wrench fa-fw"></i> Área Administrativa</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ url ('sair') }}"><i class="fa fa-sign-out fa-fw"></i> Sair</a></li>
                </ul>
            </li>
        </ul>
        <div class="navbar-default sidebar colapse" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li {{ (Request::is('') ? 'class="active"' : '') }}>
                        <a href="{{ url ('/') }}"><i class="fa fa-home fa-fw"></i> Paginal Inicial</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i> Gerenciar <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li {{ (Request::is('*Profissoes') ? 'class="active"' : '') }}>
                                <a href="{{ url ('Profissoes') }}">Profissões</a>
                            </li>
                            <li {{ (Request::is('*Carreiras') ? 'class="active"' : '') }}>
                                <a href="{{ url ('Carreiras') }}">Carreiras</a>
                            </li>
                            <li {{ (Request::is('*Assuntos') ? 'class="active"' : '') }}>
                                <a href="{{ url ('Assuntos') }}">Assuntos</a>
                            </li>
                            <li {{ (Request::is('*userSubjects') ? 'class="active"' : '') }}>
                                <a href="{{ url ('AssuntosUsuarios') }}">Assuntos Usuários</a>
                            </li>
                            <li {{ (Request::is('*users') ? 'class="active"' : '') }}>
                                <a href="{{ url ('Usuarios') }}">Usuários</a>
                            </li>
                            <li {{ (Request::is('*Contatos') ? 'class="active"' : '') }}>
                                <a href="{{ url ('Contatos') }}">Contatos</a>
                            </li>
                            <li {{ (Request::is('*mentoresAdmin') ? 'class="active"' : '') }}>
                                <a href="{{ url ('mentoresAdmin') }}">Mentores</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">@yield('page_heading', '')</h1>
            </div>
        </div>
        <div class="row">  
            @yield('section')
        </div>
    </div>
</div>
@stop