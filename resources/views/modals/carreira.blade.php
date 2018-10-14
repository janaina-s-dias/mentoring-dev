
<div class="modal fade" id="myModal2">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" data-toggle="tooltip" title="Fechar">&times;</button>
        <h4 class="modal-title">Carreira</h4>
      </div>
      <div class="modal-body">
      <form role="form"  method="POST" action="{{route('carrer.store')}}">
          @csrf
              <div class="form-group">
                  <label>Profissão</label>
                  <select class="form-control" id="profissaoCombo" name="fk_carrer_profession"> 
                      <option value="">Carregando Profissões</option>
                  </select>
                 <!-- Combo com profissões existentes -->
              </div>
            <div class="form-group">
                <label>Nome</label>
                <input type="text" name="carrer_name" class="form-control">
                <!-- <p class="help-block">Example block-level help text here.</p> -->
            </div>

          <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="carrer_active">
                    <option value="1">Ativo</option>
                    <option value="0">Inativo</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success btn-circle" data-toggle="tooltip" title="Salvar"><i class="fa fa-check"></i></button> 
            <button type="reset" class="btn btn-default btn-circle" data-toggle="tooltip" title="Limpar"><i class="fa fa-times"></i></button> 
        </form>
      </div>
    </div></div></div>
<script type="text/javascript">
    $(document).ready(function(){
       $.get('/profissao', function(dados) {
          if(dados.length > 0)
          {
              var option = "<option value=''>Selecione Profissão</option>"
              $.each(dados, function(i, obj)
              {
                  option += "<option value='"+ obj.profession_id +"'>"+ obj.profession_nome +"</option>"
              });
              $("#profissaoCombo").html(option).show();
        }
          
       });
       if({{$errors->has('carrer_name')}} || {{$errors->has('fk_carrer_profession')}})
       {
           $('#myModal2').modal('show');
       }
    });
</script>