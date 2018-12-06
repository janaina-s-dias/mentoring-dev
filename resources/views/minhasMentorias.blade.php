@extends('layouts.dashboardPerfil')

@section('titlePage')

        <title>Minhas Mentorias - Mentoring</title>

@stop

@section('stylesPage')

@stop

@section('scriptsPage')

@stop


@section('section')
<script type="text/javascript">
    $(document).ready(function(){
       $.get("{{route('knowledge.show', Auth::user()->user_id)}}", function(dados)
       {
           var niveis = {
             "1":"Basico",
             "2":"Pouco conhecimento",
             "3":"Conhecimento mediano",
             "4":"Conhecimento quase pleno",
             "5":"Conhecimento pleno",
             "6":"Bastante conhecimento",
             "7":"Experiente no assunto",
             "8":"Mestre no assunto"
           };
           var option = '';
           if(dados.length > 0){
            $.each(dados, function(i, linha)
            {
                if(linha.rank < 3)
                 option+= "<tr class='danger'>";
                else if(linha.rank < 5)
                 option+= "<tr class='warning'>";
                else if(linha.rank < 8)
                    option+= "<tr class='info'>";
                else if(linha.rank >= 8)
                    option+= "<tr class='success'>";
                 option+= "<td>"+linha.assunto+"</td>";
                 option+= "<td>"+niveis[linha.nivel]+"</td>";
                 option+= "<td>"+
                            "<div class='progress'>"+
                                "<div class='progress-bar' role='progressbar' aria-valuenow='"+linha.rank+"' aria-valuemin='0' aria-valuemax='10' style='width:"+linha.rank*10+"%'>"+
                                    "<span class='sr-only'>"+linha.rank*10+"% Complete</span>"+
                                "</div>"+
                            "</div></td>";
                 option+="<td>"+(linha.ativo ? "Ativo" : "Inativo")+"</td>";
                 option+="<td>"+linha.ativar+"</td>";
                    option+="</tr>";
                });
                $("#mentorias").html(option).show();
           }
       }, 'json');
    });
</script>
<center>
<table class="table table-condensed">
    <thead>
        <tr>
            <th>Assunto</th>
            <th>Nivel</th>
            <th>Ranking</th>
            <th>Status</th>
            <th>Ativar/Desativar</th>
        </tr>
    </thead>
    <tbody id="mentorias">

    </tbody>
</table>
</center>
@stop
