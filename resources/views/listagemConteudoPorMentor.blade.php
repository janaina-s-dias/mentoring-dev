@extends('layouts.dashboard')

@section('titlePage')

        <title>Conteudos do Mentor - Lista</title>

@stop

@section('stylesPage')


@stop

@section('scriptsPage')



@stop

@section('page_heading','Conteudos do Mentor')
@section('section')
<script type="text/javascript">
    $(document).ready(function(){
       $.get("{{route('content.showOne', $id)}}", function(dados)
       {
           var option = '';
           if(dados.length > 0){
            $.each(dados, function(i, linha)
            {
                 option+= "<tr>";
                 option+= "<td>"+linha.titulo+"</td>";
                 option+= "<td>"+linha.assunto+"</td>";
                 option+= "<td>"+linha.mentor+"</td>";
                 option+="<td>"+linha.id+"</td>";
                    option+="</tr>";
                });
                $("#conteudo").html(option).show();
           }
       }, 'json');
    });
</script>

<table class="table table-condensed">
    <thead>
        <tr>
            <th>Titulo</th>
            <th>Assunto</th>
            <th>Mentor</th>
            <th>Ver</th>
        </tr>
    </thead>
    <tbody id="conteudo">

    </tbody>
</table>


@stop
