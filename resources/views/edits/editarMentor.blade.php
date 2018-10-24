@extends('layouts.dashboardPerfil') 
@section('page_heading','')
@section('section')
@section ('table_panel_title','Editar Assunto')
@section ('table_panel_body')
<script type="text/javascript">
    $.get("{{route('subject.show', $id)}}", function(dados)
       {
           $('#assunto').val(dados.subject_id);
       }, 'json'); 
</script>    
<form method="POST" action="{{route('alteraMentor')}}">
    @csrf
    <input type="hidden" id="assunto" name="fk_knowledge_subject"/>
    <select id="mentorCombo" name="knowledge_nivel" class="form-control">
        <option value="3">Conhecimento mediano</option>
        <option value="4">Conhecimento quase pleno</option>
        <option value="5">Conhecimento pleno</option>
        <option value="6">Bastante conhecimento</option>
        <option value="7">Experiente no assunto</option>
        <option value="8">Mestre no assunto</option>
    </select>
    <input type="submit" class="btn btn-success" value="Enviar" name="enviando"/>
</form>
@include('inc.feedback')
@endsection
@include('widgets.panel', array('header'=>true, 'as'=>'table'))
@stop