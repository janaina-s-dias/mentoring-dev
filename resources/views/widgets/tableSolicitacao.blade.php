<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript"> 
    $(document).ready(function (){
       var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
       $('#tabelaSolicitacao').DataTable({
           "processing": true,
           "serverSide": true,
           "order": [],
           "dom": '<"top">rt<"bottom"ip><"clear">',
           "ajax": {
               "url": "{{ route('pegaDadosSolicitacao') }}", //url Controller Conexao - PegaDados
               "type": "POST",
               "data": {_token: CSRF_TOKEN}
           },
           "columnDefs": [
                {
                    "targets": [ 2, 3 ], //quais colunas não possuirão a ordenação - editar/excluir
                    "orderable":false
                }
           ],
           "language": {
                "zeroRecords": "Nada encontrado - desculpe",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponivel",
                "infoFiltered": "(filtrado do total de _MAX_ registros)",
                "paginate": {
                    "first":      "Primeira",
                    "last":       "Última",
                    "next":       "Próxima",
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
<table id="tabelaSolicitacao" class="table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">Usuário</th>    
            <th style="text-align:center">Assunto</th>
            <th style="text-align:center">Aceitar</th>  
            <th style="text-align:center">Recusar</th>                    
        </tr>
    </thead>
    <tbody style="text-align:center">
    </tbody>
</table>
</div>