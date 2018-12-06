@extends('layouts.dashboardPerfil')
@section('section')
@section ('table_panel_title','Editar Assunto')
@section ('table_panel_body')

@section('section')
<script type="text/javascript">
    $(document).ready(function(){
       $.get("{{route('mentorOuNao')}}", function(dados)
       {
           var option = '';
           if(dados.length > 0){
            $.each(dados, function(i, linha)
            {
                if(linha.mentor === "Não")
                    option+= "<tr class='warning'>";
                else
                    option+= "<tr class='success'>";
                    option+= "<td>"+linha.assunto+"</td>";
                    option+= "<td>"+linha.carreira+"</td>";
                    option+= "<td>"+linha.profissao+"</td>";
                    option+= "<td>"+linha.mentor+"</td>";
                    option+= "<td>"+linha.editar+"</td>";
                    option+="</tr>";
                });
                $("#editarMentoria").html(option).show();
           }
       }, 'json');
    });
</script>
<table class="table table-condensed">
    <thead>
        <tr>
            <th>Assunto</th>
            <th>Carreira</th>
            <th>Profissão</th>
            <th>Mentoria</th>
            <th>Editar</th>
        </tr>
    </thead>
    <tbody id="editarMentoria">

    </tbody>
</table>
@include('inc.feedback')
@endsection
@include('widgets.panel', array('header'=>true, 'as'=>'table'))
@stop
