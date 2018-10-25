@extends('layouts.dashboardPerfil')
@section('page_heading','Minhas Mentorias')
@section('section')
<script type="text/javascript">
    $(document).ready(function(){
       $.get("{{route('contact.show', Auth::user()->user_id)}}", function(dados)
       {
           var option = '';
           if(dados.length > 0){
            $.each(dados, function(i, linha)
            {
                option+= "<tr>";
                option+= "<td>"+linha.tipo+"</td>";
                option+= "<td>"+linha.contato+"</td>";
                option+= "<td>"+linha.editar+"</td>";
                option+= "<td>"+linha.excluir+"</td>";
                option+="</tr>";
                });
                $("#contatos").html(option).show();
           }
       }, 'json'); 
    });
</script>    
<center>
<table class="table table-condensed">
    <thead>
        <tr>
            <th>Tipo</th>
            <th>Contato</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>
    </thead>
    <tbody id="contatos">
        
    </tbody>
</table>
</center>
@include('inc.feedback')
@stop
