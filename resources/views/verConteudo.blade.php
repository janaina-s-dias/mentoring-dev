@extends('layouts.dashboardPerfil') 
@section('page_heading','Ver Conteúdo')
@section('section')



<center><h2>{{$conteudo->content_title}}</h2></center>

    <small style="margin-right: 0px">Mentor: {{$conteudo->user_nome}}</small>
    <small style="margin-right: 0px">Assunto: {{$conteudo->subject_name}}</small>

<br/>
<br/>
<br/>

{!!$conteudo->content_content!!}




@stop
