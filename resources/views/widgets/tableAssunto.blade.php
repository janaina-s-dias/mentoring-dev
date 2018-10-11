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
</table>-->
 
<?php //@include('modals.carreira'); ?>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript"> 
    $(document).ready(function (){
       var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
       $('#tabelaAssunto').DataTable({
           "processing": true,
           "serverSide": true,
           "order": [],
           "ajax": {
               "url": "{{ route('pegaDadosAssunto') }}", //url Controller Assunto - PegaDados
               "type": "POST",
               "data": {_token: CSRF_TOKEN}
           },
           "columnDefs": [
                {
                    "targets": [ 4,  5 ], //quais colunas não possuirão a ordenação - editar/excluir
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

<div>
<table id="tabelaAssunto" class="table-responsive">
    <thead>
        <tr>
            <th>Código</th>
            <th>Assunto</th>
            <th>Status</th>
            <th>Carreira</th>            
            <th>Alterar</th>
            <th>Excluir</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</div>