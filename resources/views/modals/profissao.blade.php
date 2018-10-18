<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" data-toggle="tooltip" title="Fechar">&times;</button>
        <h4 class="modal-title">Profissão</h4>
      </div>
      <div class="modal-body">
      <form role="form" method="POST" action="{{route('profession.store')}}">
          @csrf
            <div class="form-group{{ $errors->has('profession_name') ? ' has-error' : '' }}">
                <label>Nome</label>
                <input class="form-control" name="profession_name">
                <!-- <p class="help-block">Example block-level help text here.</p> -->
                @if ($errors->has('profession_name'))
                                <small class="text-danger" role="alert">
                                    <strong>{{ $errors->first('profession_name') }}</strong>
                                </small>
                @endif
            </div>
                <input type="hidden" value="1" name="profession_active">
                <button type="submit" class="btn btn-success btn-circle" data-toggle="tooltip" title="Salvar"><i class="fa fa-check"></i></button> 
                <button type="reset" class="btn btn-default btn-circle" data-toggle="tooltip" title="Limpar"><i class="fa fa-times"></i></button> 
        </form>
      </div>
    </div>
    </div>
    </div>
<script type="text/javascript">
    $(document).ready(function(){
       if({{$errors->has('profession_name')}})
       {
           $('#myModal').modal('show');
       }
    });
</script>
