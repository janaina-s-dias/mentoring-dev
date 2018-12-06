
<div class="modal fade" id="myModal2" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" data-toggle="tooltip" title="Fechar">&times;</button>
        <h4 class="modal-title">Carreira</h4>
      </div>
      <div class="modal-body">
      <form role="form"  method="POST" action="{{route('carrer.store')}}">
          @csrf
              <div class="form-group{{ $errors->has('fk_carrer_profession') ? ' has-error' : '' }}">
                  <label>Profissão</label>
                  <select class="form-control" id="profissaoCombo" name="fk_carrer_profession">
                      <option value="">Carregando Profissões</option>
                  </select>
                 @if ($errors->has('fk_carrer_profession'))
                                <small class="text-danger" role="alert">
                                    <strong>{{ $errors->first('fk_carrer_profession') }}</strong>
                                </small>
                @endif
              </div>
            <div class="form-group{{ $errors->has('carrer_name') ? ' has-error' : '' }}">
                <label>Nome</label>
                <input type="text" name="carrer_name" class="form-control" value="{{old('carrer_name')}}">
                @if ($errors->has('carrer_name'))
                                <small class="text-danger" role="alert">
                                    <strong>{{ $errors->first('carrer_name') }}</strong>
                                </small>
                @endif
            </div>

                <input type="hidden" value="1" name="carrer_active">
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
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
       if({{$errors->hasAny(array('carrer_name', 'fk_carrer_profession'))}})
           $('#myModal2').modal('show');
        });
    </script>
