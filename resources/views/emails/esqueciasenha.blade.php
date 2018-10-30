@extends('layouts.plane')
@section('body')
<style>
.badge-notify{
   color:white;
   position:relative;
   border-radius: 50px;
   top: -6px;
   left: -6px;
}
</style>
<div id="wrapper">
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: rgb(0,176,176);">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://localhost:9000" style="color:white;">Logar</a>
        </div>
        <ul class="nav navbar-top-links navbar-right">         
        </ul>
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                </ul>
            </div>
        </div>
    </nav>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Esqueci minha senha</h1>
            </div>
        </div>
	<div class="row">  
            {{-- Conteudo --}}
        </div>
    </div>
</div>
@stop