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
                <select class="form-control" id="profissaoCombo" name="fk_carrer_profession"> 
                    <option value="">Carregando Profissões</option>
                </select>
            </div>

              <div class="form-group{{ $errors->has('fk_subject_carrer') ? ' has-error' : '' }}">
                  <label>Carreira</label>
                  <select class="form-control" name="fk_subject_carrer" id="carrerCombo">
                      <option value="">Carregando Carreira</option>
                  </select>
                 <!-- Combo com carreiras existentes -->
                 @if ($errors->has('fk_subject_carrer'))
                                <small class="text-danger" role="alert">
                                    <strong>{{ $errors->first('fk_subject_carrer') }}</strong>
                                </small>
                @endif
              </div>
              <div class="form-group{{ $errors->has('subject_name') ? ' has-error' : '' }}">
                <label>Nome</label>
                <input type="text" name="subject_name" class="form-control" value="{{old('subject_name')}}">
                <!-- <p class="help-block">Example block-level help text here.</p> -->
                @if ($errors->has('subject_name'))
                                <small class="text-danger" role="alert">
                                    <strong>{{ $errors->first('subject_name') }}</strong>
                                </small>
                @endif
            </div>
            
              <input type="hidden" value="1" name="subject_active">
              <button type="submit" class="btn btn-success btn-circle" data-toggle="tooltip" title="Salvar"><i class="fa fa-check"></i></button> 
            <button type="reset" class="btn btn-default btn-circle" data-toggle="tooltip" title="Limpar"><i class="fa fa-times"></i></button> 
        </form>
      </div>
    </div>
  </div>
</div>
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
<<<<<<< HEAD
          $("#profissaoCombo").html(option).show();
=======
          
>>>>>>> refs/remotes/origin/master
       });
       $('#profissaoCombo').change(function (){
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

<script type="text/javascript">
$(document).ready(function(){
    if({{$errors->hasAny(array('subject_name', 'fk_subject_carrer'))}})
       {
           $('#myModal3').modal('show');
       }
    });
</script>