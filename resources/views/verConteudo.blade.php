@extends('layouts.dashboardPerfil')

@section('titlePage')

        <title>Ver Conteúdo - Mentoring</title>

@stop

@section('stylesPage')


@stop

@section('scriptsPage')

@stop


@section('section')



<center><h2>{{$conteudo->content_title}}</h2></center>

<small class="col col-sm-offset-9">Mentor: {{$conteudo->user_nome}} Assunto: {{$conteudo->subject_name}}</small>

<br/>
<br/>
<br/>

{!!$conteudo->content_content!!}




@stop
