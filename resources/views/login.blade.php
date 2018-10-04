@extends ('layouts.plane')
@section ('body')
<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
            <br /><br /><br />
               @section ('login_panel_title','Sign In')
               @section ('login_panel_body')
                        <form role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Usuario" name="user_login" type="text" value="{{old('user_login')}}" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Senha" name="user_hash" type="password">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <a href="{{ url ('/') }}" class="btn btn-md btn-primary btn-block">Sign in</a> 
                                <a href="#" class="btn btn-md btn-success btn-block" data-toggle="modal" data-target="#modalCadastro">Sign up</a>
                            </fieldset>
                        </form>
                    
                @endsection
                @include('widgets.panel', array('as'=>'login', 'header'=>true))
            </div>
        </div>
    </div>


<div class="modal fade" id="modalCadastro" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
                <h3 class="modal-title" id="modalTitulo">Cadastrar</h3>  
            </div>
            <form  method="POST" action="{{ route('inserir') }}">
                @csrf
                <div class="modal-body">
                <div class="form-group">
                    <input class="form-control" name="user_nome" id="nome" type="text" placeholder="Nome">
                </div>
                <div class="form-group">
                    <input class="form-control" name="user_login" id="user" type="text" placeholder="Usuario">
                </div>
                <div class="form-group">
                    <input class="form-control" name="user_hash" id="senha" type="password" placeholder="Senha">
                </div>
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-success" value="Cadastrar" role="button">
              <button type="reset" class="btn btn-default btn-circle" data-toggle="tooltip" title="Limpar"><i class="fa fa-times"></i></button> 
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>


