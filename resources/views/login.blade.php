@extends ('layouts.plane')
@section ('body')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="{{ asset('js/jquery.mask.js') }}"></script>
<br><br><br><br><br><br>
<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
            <br /><br /><br />
               @section ('login_panel_title','Tela de Acesso - Mentoring')
               @section ('login_panel_body')
               <form role="form" action="{{ route ('acessar') }}" method="post">
                        @csrf
                            <fieldset>
                                <div class="form-group{{ $errors->has('user_login_login') ? ' has-error' : '' }}">
                                    <input class="form-control" placeholder="Usuario" name="user_login_login" type="text" value="{{old('user_login')}}" autofocus>
                                    @if ($errors->has('user_login_login'))
                                    <small class="text-danger" role="alert">
                                        <strong>{{ $errors->first('user_login_login') }}</strong>
                                    </small>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('user_hash_login') ? ' has-error' : '' }}">
                                    <input class="form-control" placeholder="Senha" name="user_hash_login" type="password">
                                    @if ($errors->has('user_hash_login'))
                                    <small class="text-danger" role="alert">
                                        <strong>{{ $errors->first('user_hash_login') }}</strong>
                                    </small>
                                    @endif
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Lembre-se
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-md btn-primary btn-block">Entrar</button>
                                <a href="#" class="btn btn-md btn-success btn-block" data-toggle="modal" data-backdrop="static" data-target="#modalCadastro">Cadastrar</a>
                            </fieldset>
                   </form>
                    
                @endsection
                @include('widgets.panel', array('as'=>'login', 'header'=>true))
            @include('inc.feedback')
        </div>
        </div>
            
    </div>


<div class="modal fade" id="modalCadastro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Cadastro Inicial</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  method="POST" action="{{ route('inserir') }}">
                @csrf
                <div class="form-group{{ $errors->has('user_email') ? ' has-error' : '' }}">
                    <input class="form-control" name="user_email" id="email" type="text" placeholder="E-mail" value="{{old('user_email')}}">
                    <p class="help-block">Insira um e-mail válido</p> 
                    @if ($errors->has('user_email'))
                        <small class="text-danger" role="alert">
                            <strong>{{ $errors->first('user_email') }}</strong>
                        </small>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('user_login') ? ' has-error' : '' }}">
                    <input class="form-control" name="user_login" id="user" type="text" placeholder="Usuario"value="{{old('user_login')}}">
                    <p class="help-block">Mínimo 8 caracteres</p> 
               @if ($errors->has('user_login'))
                    <small class="text-danger" role="alert">
                        <strong>{{ $errors->first('user_login') }}</strong>
                    </small>
                @endif
                </div>
                <div class="form-group{{ $errors->has('user_hash') ? ' has-error' : '' }}">
                    <input class="form-control" name="user_hash" id="senha" type="password" placeholder="Senha">
                    <p class="help-block">Mínimo 8 caracteres</p> 
                    @if ($errors->has('user_hash'))
                    <small class="text-danger" role="alert">
                        <strong>{{ $errors->first('user_hash') }}</strong>
                    </small>
                @endif
                </div>
               
                <div class="form-group{{ $errors->has('user_hash') ? ' has-error' : '' }}">
                    <input class="form-control" name="user_hash_confirmation" id="confisenha" type="password" placeholder="Confirmação de Senha">
                @if ($errors->has('user_hash'))
                    <small class="text-danger" role="alert">
                        <strong>{{ $errors->first('user_hash') }}</strong>
                    </small>
                @endif
                </div> 
        
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-success col-auto mr-auto" value="Cadastrar" role="button" onclick="return validarSenha()">
        <button type="reset" class="btn btn-default btn-circle" data-toggle="tooltip" title="Limpar"><i class="fa fa-times"></i></button>
      </form>
      </div>
    </div>
  </div>
</div>

<!-- Verifica a confirmação de senha -->
<script type="text/javascript">
    $(document).ready(function(){
        if({{$errors->hasAny(array('user_hash', 'user_login', 'user_email'))}})
        {
           $('#modalCadastro').modal('show');
        }
    });
</script>
