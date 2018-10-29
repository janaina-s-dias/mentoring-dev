@extends('layouts.dashboard')
@section('page_heading','Conteudo do Mentor: '.$nome)
@section('section')

<table class="table">
    <thead>
        <tr>
            <th>Assunto</th>
            <th>Título</th>
            <th>Tipo</th>    
            <th>Ver</th> 
        </tr>
    </thead>
    <tbody>
        @foreach($conteudos as $conteudo)
        <tr>
            <td>{{$conteudo->subject_name}}</td> 
            <td>{{$conteudo->content_title}}</td> 
            <td>{{($conteudo->content_type == 1) ? 'Conteudo' : ''}}</td> 
            <td><a href='{{route('content.show', $conteudo->content_id)}}' role='button' class='btn' style='background-color: rgb(0,176,176); color: white'> Ver </a></td> 
        </tr>
        @endforeach
    </tbody>
</table>

@stop
