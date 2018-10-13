<div class="modal fade" id="myModal3">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" data-toggle="tooltip" title="Fechar">&times;</button>
        <h4 class="modal-title">Assunto</h4>
      </div>
      <div class="modal-body">
          <form role="form" method="POST" action="{{route('subject.store')}}">
              @csrf
            <div class="form-group">
                <label>Profissão</label>
                <select class="form-control" id="profissaoCombo"> 
                    <option value="">Carregando Profissões</option>
                </select>
            </div>

              <div class="form-group">
                  <label>Carreira</label>
                  <select class="form-control" name="fk_carrer_subject" id="carrerCombo">
                      <option value="">Carregando Carreira</option>
                  </select>
                 <!-- Combo com carreiras existentes -->
              </div>
              <div class="form-group">
                <label>Nome</label>
                <input type="text" name="subject_name" class="form-control">
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
    </div>
  </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
       $get('/profissao', function(dados) {
          if(dados.length > 0)
          {
              var option = "<option value=''>Selecione Profissão</option>"
              $.each(dados, function(i, obj)
              {
                  option += "<option value='"+ obj.profession_id +"'>"+ obj.profession_nome +"</option>"
              });
          }
          $("#profissaoComno").html(option).show();
       });
       $('#professaoCombo').change(function (){
        var profissao = $('#profissaoCombo').val();
        $.get('/carreira?profissao='+profissao, function(dados){
            if (dados.length > 0){
                var option = "<option value=''>Selecione Carreira</option>"; 
                $.each(dados, function(i, obj){
                    option += "<option value='"+obj.carrer_id+"'>"+
                        obj.carrer_nome+"</option>";
                });
                 
            } else {
                $("#carrerCombo").empty();
                var option = "<option value=''>Carregando Carreira</option>";
            }
        $("#carrerCombo").html(option).show();
         }); 
    });
    });
</script>