<!--<table class="table {{ $class }}">
	<thead>
		<tr>
			<th>Nome</th>
			<th>Status</th>
			<th colspan="2">Ações</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Tecnologia da Informação</td>
			<td>Ativo</td>
			<td><button type="button" class="btn btn-primary btn-circle" data-toggle="modal" data-toggle="tooltip" title="Alterar" data-target="#myModal"><i class="fa fa-edit"></i></button> </td>
			<td><button type="button" class="btn btn-danger btn-circle" data-toggle="tooltip" title="Excluir"><i class="fa fa-trash-o"></i></button> </td>


		</tr>
	</tbody>
</table>
 
@include('modals.profissao')-->



<script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" type="text/javascript"></script>
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript"> 
    $(document).ready(function (){
       var dataTable = $('#tabelaCategoria').DataTable({
           "processing": true,
           "serverSide": true,
           "order": [],
           "ajax": {
               "url": "{{ route('pegaDados') }}", //url Controller Profession - PegaDados
               "type": "POST"
           },
           "columnsDefs": [
                {
                    "target": [3, 4], //quais colunas não possuirão a ordenação - editar/excluir
                    "orderable":false
                }
           ],
           "language": {
                "zeroRecords": "Nada encontrado - desculpe",
                "info": "Mostrando pagina _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponivel",
                "infoFiltered": "(filtrado do total de _MAX_ registros)",
                "paginate": {
                    "first":      "Primeira",
                    "last":       "Ultima",
                    "next":       "Proxima",
                    "previous":   "Anterior"
                },
                "search":         "Pesquisar:",
                "loadingRecords": "Carregando...",
                "processing":     "Processando..."
        },
            "lengthChange": false,
            "pageLength": 15
       }); 
    });
</script>

<table id="tabelaCategoria" class="table-responsive">
    <thead>
        <tr>
            <th>#</th>
            <th>Profession</th>
            <th>Status</th>
            <th>Editar</th>
            <th>Deletar</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
