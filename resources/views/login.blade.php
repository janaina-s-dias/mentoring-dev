@extends ('layouts.plane')
@section ('body')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
            <br /><br /><br />
               @section ('login_panel_title','Acessar')
               @section ('login_panel_body')
               <form role="form" action="{{ route ('acessar') }}" method="post">
                        @csrf
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control{{ $errors->has('user_login') ? ' is-invalid' : '' }}" placeholder="Usuario" name="user_login" type="text" value="{{old('user_login')}}" autofocus>
                                    @if ($errors->has('user_login'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user_login') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input class="form-control{{ $errors->has('user_hash') ? ' is-invalid' : '' }}" placeholder="Senha" name="user_hash" type="password">
                                    @if ($errors->has('user_hash'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user_hash') }}</strong>
                                    </span>
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
        <h3 class="modal-title" id="exampleModalLabel">Cadastro</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  method="POST" action="{{ route('inserir') }}">
                @csrf
                <div class="form-group">
                    <input class="form-control" name="user_nome" id="nome" required type="text" placeholder="Nome">
                </div>
                <div class="form-group">
                    <input class="form-control" name="user_login" id="user" required type="text" placeholder="Usuario">
                </div>
                <div class="form-group">
                    <input class="form-control" name="user_hash" id="senha" required type="password" placeholder="Senha">
                </div>
                <div class="form-group">
                    <input class="form-control" name="user_hash_confirmed" id="confirmar_senha" required type="password" placeholder="Confirmar Senha">
                </div>
                <div class="form-group">
                    <input class="form-control" name="user_email" id="email" required type="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <input class="form-control" name="user_rg" id="rg" required type="text" placeholder="RG" pattern="\d{2}\.\d{3}\.\d{3}-\d{1}" title="No formato (##.###.###-#)">
                </div>
                <div class="form-group">
                    <input class="form-control" name="user_cpf" id="cpf" required type="text" placeholder="CPF" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="No formato (###.###.###-##)">
                </div>
                <div class="form-group">
                    <input class="form-control" name="user_telefone" id="telefone" required type="tel" placeholder="Telefone"
                    pattern="[0-9]{2} [0-9]{4}-[0-9]{4}" title="No formato ((##) ####-####)">
                </div>
                <div class="form-group">
                    <input class="form-control" name="user_celular" id="celular" required type="tel" placeholder="Celular" pattern="[0-9]{2} [0-9]{5}-[0-9]{4}" title="No formato ((##) #####-####)">
                </div>
        </form>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-success col-auto mr-auto" value="Cadastrar" role="button" onclick="return validarSenha()">
        <button type="reset" class="btn btn-default btn-circle" data-toggle="tooltip" title="Limpar"><i class="fa fa-times"></i></button>
      </div>
    </div>
  </div>
</div>

<!-- Verifica a confirmação de senha -->
<script>
    
    function validarSenha(){
        senha = document.getElementsByName('senha').value;
        confirmar_senha = document.getElementsByName('confirmar_senha').value;

       if(senha!= confirmar_senha) {
          senha2.setCustomValidity("Senhas diferentes!");
          return false; 
       }
          return true;
       }

</script>