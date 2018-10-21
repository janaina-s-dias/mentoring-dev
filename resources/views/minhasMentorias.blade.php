@extends('layouts.dashboardPerfil')
@section('page_heading','Minhas Mentorias')
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
                 option+= "<td>"+linha.rank+"</td>";
                 option+="<td>"+(linha.ativo ? "Ativo" : "Inativo")+"</td>";
                    option+="</tr>";
                });
                $("#mentorias").html(option).show();
           }
       }, 'json'); 
    });
</script>    
<table class="table table-condensed">
    <thead>
        <tr>
            <th>Assunto</th>
            <th>Nivel</th>
            <th>Ranking</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody id="mentorias">
        
    </tbody>
</table>
@stop
