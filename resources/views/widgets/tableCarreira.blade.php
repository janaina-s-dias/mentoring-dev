<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript"> 
    $(document).ready(function (){
       var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
       $('#tabelaCarreira').DataTable({
           "processing": true,
           "serverSide": true,
           "order": [],
           "dom": '<"top">rt<"bottom"ip><"clear">',
           "ajax": {
               "url": "{{ route('pegaDadosCarreira') }}", //url Controller Carreira - PegaDados
               "type": "POST",
               "data": {_token: CSRF_TOKEN}
           },
           "columnDefs": [
                {
                    "targets": [ 4, 5, 6 ], //quais colunas não possuirão a ordenação - editar/excluir
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
<table id="tabelaCarreira" class="table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">Código</th> 
            <th style="text-align:center">Carreira</th>
            <th style="text-align:center">Profissão</th>
            <th style="text-align:center">Status</th>
            <th style="text-align:center">Ativar</th>
            <th style="text-align:center">Alterar</th>
            <th style="text-align:center">Excluir</th> 
        </tr>
    </thead>
    <tbody style="text-align:center">
    </tbody>
</table>
</div>