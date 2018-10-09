<script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" type="text/javascript"></script>
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript"> 
    $(document).ready(function (){
        carregar();
        $.getJSON("<?= base_url().'usuario/subcategoria/all'?>", function(dados){
            var option = "<option value=''>Subcategoria</option>"; 
            if (dados.length > 0){
                $.each(dados, function(i, obj){
                    option += "<option value='"+obj.subcategoria_id+"'>"+
                        obj.subcategoria_nome+'</option>';
                });
            }
            $("#subcategoriaSearch").html(option).show();
        });
        $('#subcategoriaSearch').change(function(){
            $('#tabelaUsuario').DataTable().destroy();
            carregar();
        });
        function carregar(){
            $('#tabelaUsuario').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "destroy": true,
                    "order": [],
                    "ajax": {
                        "url": "<?= base_url().'usuario/pega_dados'?>",
                        "type": "POST",
                        "data": function(data)
                            {
                                data.subcategoria = $('#subcategoriaSearch').val();
                            }
                        },
                    "columnDefs": [ {
                        "targets": [6, 7 ],
                         "orderable": false
                    } ],
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
        }
    });
</script>

<table id="tabelaUsuario" class="table-responsive">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Data</th>
            <th>Subcategoria</th>
<!--                <th><select id="subcategoriaSearch" name="subcategoriaSearch" class="form-control">
                        <option value="">Subcategoria</option>
                </select></th>-->
            <th>Categoria</th>
            <th>Editar</th>
            <th>Deletar</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
<?php if ($this->session->flashdata('error') == TRUE): ?>
    <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong><?php echo $this->session->flashdata('error'); ?></strong>
    </div>
<?php endif; ?>
<?php if ($this->session->flashdata('success') == TRUE): ?>
	<div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong><?php echo $this->session->flashdata('success'); ?></strong>
    </div>
<?php endif;?>