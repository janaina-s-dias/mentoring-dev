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
            <div class="form-group">
                <label>Nome</label>
                <input class="form-control" name="profession_name">
                <!-- <p class="help-block">Example block-level help text here.</p> -->
            </div>
              <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="profession_active">
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