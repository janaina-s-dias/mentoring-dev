<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript"> 
    $(document).ready(function (){
       var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
       $('#tabelaUsuario').DataTable({
           "processing": true,
           "serverSide": true,
           "order": [],
           "dom": '<"top">rt<"bottom"ip><"clear">',
           "ajax": {
               "url": "{{ route('pegaDadosUsuario') }}", 
               "type": "POST",
               "data": {_token: CSRF_TOKEN}
           },
           "columnDefs": [
                {
                    "targets": [ 9 ],  
                    "orderable": false
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
            "pageLength": 10
       }); 
    });
</script>

<div>
<table id="tabelaUsuario" class="table-responsive">
    <thead>
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Login</th>
            <th>Email</th>
            <th>CPF</th>
            <th>RG</th>
            <th>Telefone</th>
            <th>Celular</th>
            <th>Mentor?</th>
            <!--<th>Ver assuntos</th>-->
            <th>Excluir</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</div>