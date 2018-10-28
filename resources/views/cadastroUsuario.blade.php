<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentoring</title>
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        
        <!-- arrumar -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>  
</head> 
<body>
    @include("layouts.cabecalho")
    <div class="container" style="margin-top: 50px">
        <form class="form-horizontal mx-auto" method="POST" action="{{ route('inserir') }}" style="width: 800px">
        @csrf
        <fieldset>
            <div class="form-group row{{ $errors->has('user_nome') ? 'is-invalid' : '' }}">
                <label class="col-form-label col-sm-2" for="nome">Nome:</label>
                    <div class="col-sm-8">
                        <input class="form-control"  value="{{old('user_nome')}}" name="user_nome" id="nome" type="text" autofocus placeholder="Nome">
                        @if ($errors->has('user_nome'))
                        <small class="text-danger" role="alert">
                            <strong>{{ $errors->first('user_nome') }}</strong>
                        </small>
                        @endif
                    </div>                     
            </div>

            <div class="form-group row{{ $errors->has('user_email') ? 'is-invalid' : '' }}">
                <label class="col-form-label col-sm-2" for="email">Email:</label>
                    <div class="col-sm-8">
                        <input class="form-control"  value="{{old('user_email')}}" name="user_email" id="email" type="text" placeholder="Email">
                        @if ($errors->has('user_email'))
                        <small class="text-danger" role="alert">
                            <strong>{{ $errors->first('user_email') }}</strong>
                        </small>
                        @endif
                    </div>                     
            </div>
                
            <div class="form-group row{{ $errors->has('user_login') ? 'is-invalid' : '' }}">
                <label class="col-form-label col-sm-2" for="login">Login:</label>
                    <div class="col-sm-8">
                        <input class="form-control"  value="{{old('user_login')}}" name="user_login" id="login" type="text" placeholder="Login">
                        @if ($errors->has('user_login'))
                        <small class="text-danger" role="alert">
                            <strong>{{ $errors->first('user_login') }}</strong>
                        </small>
                        @endif
                    </div>                     
            </div>      
                
            <div class="form-group row{{ $errors->has('user_hash') ? 'is-invalid' : '' }}">
                <label class="col-form-label col-sm-2" for="hash">Senha:</label>
                    <div class="col-sm-8">
                        <input class="form-control"  value="{{old('user_hash')}}" name="user_hash" id="user_hash" type="password" placeholder="Senha">
                        @if ($errors->has('user_hash'))
                        <small class="text-danger" role="alert">
                            <strong>{{ $errors->first('user_hash') }}</strong>
                        </small>
                        @endif
                    </div>                     
            </div>
                
                <div class="form-group row{{ $errors->has('user_hash_confirmation') ? 'is-invalid' : '' }}">
                <label class="col-form-label col-sm-2" for="hash_confirmation">Confirmação:</label>
                    <div class="col-sm-8">
                        <input class="form-control"  value="{{old('user_hash_confirmation')}}" name="user_hash_confirmation" id="user_hash_confirmation" type="password" placeholder="Confirmar senha">
                        @if ($errors->has('user_hash_confirmation'))
                        <small class="text-danger" role="alert">
                            <strong>{{ $errors->first('user_hash_confirmation') }}</strong>
                        </small>
                        @endif
                    </div>                     
            </div>
                
            <input type="hidden"  name="user_id">

            <div class="form-group row{{ $errors->has('user_rg') ? 'is-invalid' : '' }}">
                    <label class="col-form-label col-sm-2" for="rg">RG:</label>
                        <div class="col-sm-8">
                            <input class="form-control" value="{{old('user_rg')}}" name="user_rg" id="rg" type="text" placeholder="RG" maxlength="9">
                            @if ($errors->has('user_rg'))
                            <small class="text-danger" role="alert">
                                <strong>{{ $errors->first('user_rg') }}</strong>
                            </small>
                                @endif
                        </div>
            </div>
            <input name="user_role" type="hidden" value="uset">

            <div class="form-group row{{ $errors->has('user_cpf') ? 'is-invalid' : '' }}">
                <label class="col-form-label col-sm-2" for="nome">CPF:</label>
                    <div class="col-sm-8">
                        <input class="form-control" value="{{old('user_cpf')}}" name="user_cpf" id="cpf" type="text" placeholder="CPF">
                        @if ($errors->has('user_cpf'))
                        <small class="text-danger" role="alert">
                            <strong>{{ $errors->first('user_cpf') }}</strong>
                        </small>
                        @endif
                    </div>
            </div>

            <div class="form-group row{{ $errors->has('user_telefone') ? 'is-invalid' : '' }}">
                <label class="col-form-label col-sm-2" for="telefone">Telefone:</label>
                    <div class="col-sm-8">
                        <input value="{{old('user_telefone')}}" class="form-control" name="user_telefone" id="telefone" type="text" placeholder="Telefone">
                        @if ($errors->has('user_telefone'))
                        <small class="text-danger" role="alert">
                            <strong>{{ $errors->first('user_telefone') }}</strong>
                        </small>
                        @endif
                    </div>
            </div>

            <div class="form-group row{{ $errors->has('user_celular') ? 'is-invalid' : '' }}">
                    <label class="col-form-label col-sm-2" for="celular">Celular:</label>
                        <div class="col-sm-8">
                            <input class="form-control" value="{{old('user_celular')}}" name="user_celular" id="celular" type="text" placeholder="Celular">
                            @if ($errors->has('user_celular'))
                            <small class="text-danger" role="alert">
                                <strong>{{ $errors->first('user_celular') }}</strong>
                            </small>
                            @endif
                        </div>
            </div>
            
            <div class="form-group row">
                <div class="col-md-2">
                    <strong><p>Deseja ser mentor?</p></strong>
                </div>
                
                <div class="col-md-2">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">                                
                                <label class="btn" style="background-color: rgb(0,176,176); color:white;">
                                            <input type="radio" name="user_knowledge" id="option1" autocomplete="off" value="1" checked> Sim
                                        </label>
                                        <label class="btn active" style="background-color: rgb(0,176,176);  color:white;">
                                            <input type="radio" name="user_knowledge" id="option2" value="0" autocomplete="off"> Não
                                        </label>
                            </div>    
                </div>
            </div>
                            <!-- 
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
  <label class="btn btn-secondary active">
    <input type="radio" name="options" id="option1" autocomplete="off" checked> Active
  </label>
  <label class="btn btn-secondary">
    <input type="radio" name="options" id="option2" autocomplete="off"> Radio
  </label>
  <label class="btn btn-secondary">
    <input type="radio" name="options" id="option3" autocomplete="off"> Radio
  </label>
</div>-->
                    
        
    </fieldset>        
        <div class="form-group row" class="mx-auto" style="margin-left:550px"> 
            <div>
            <div class="btn-group">
                <button type="submit" class="btn btn-success">Salvar</button>
                </div>
                <div class="btn-group">
                <a href="{{route('sair')}}" role="button" class="btn btn-danger">Sair</a>                    
            </div>                  
        </div>
    </div>
</form>
        
    </div>
        
        <script type="text/javascript">
            $(document).ready(function(){
               $("#rg").mask('99.999.999-9'); 
               $("#cpf").mask('999.999.999-99'); 
               $("#telefone").mask('(99) 9999-9999'); 
               $("#celular").mask('(00) 0000-00009');
               $("#celular").blur(function(event){
                   if ($(this).val().length == 15){
                       $("#celular").mask('(00) 00000-0009');
                   } else {
                       $("#celular").mask('(00) 0000-00009');
                   }
                    });
               
            });
        </script>
        <script>
            $(document).ready(function(){
                $(".btn-secondary:first").click(function(){
                    $(this).button('toggle');
                });   
            });
</script>
</body>
<div class="mx-auto" style="width: 800px">
    @include('inc.feedback')
</div>                  
</html>