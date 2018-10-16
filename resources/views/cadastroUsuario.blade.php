<!DOCTYPE html>
<html>
    <head>
        <title>Mentoring</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="{{ asset('js/jquery.mask.js') }}"></script>
        <style type="text/css" rel="stylesheet">
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
            /* display: none; <- Crashes Chrome on hover */
            -webkit-appearance: none;
            margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
            }

        input[type=number] {
            -moz-appearance:textfield;
        }
        </style>
    </head>
    <body>
        <?php $user = Session::get('user'); ?>
    <div class="container" style="margin-top: 50px">
        <fieldset>
            <legend>Para prosseguir, conclua o cadastro</legend><br>
                <form class="form-horizontal" method="POST" action="{{ route('inserirUser') }}">
                    @csrf
                    <div class="form-group row{{ $errors->has('user_nome') ? ' has-error' : '' }}">
                        <label class="col-form-label col-sm-2" for="nome">Nome:</label>
                            <div class="col-sm-10">
                                <input class="form-control"  value="{{old('user_nome')}}" name="user_nome" id="nome" type="text" placeholder="Nome">
                                @if ($errors->has('user_nome'))
                                <small class="text-danger" role="alert">
                                    <strong>{{ $errors->first('user_nome') }}</strong>
                                </small>
                                @endif
                            </div>                     
                    </div>
                    <input type="hidden" value="{{ $user->user_id }}" name="user_id">

                    <div class="form-group row{{ $errors->has('user_rg') ? ' has-error' : '' }}">
                            <label class="col-form-label col-sm-2" for="rg">RG:</label>
                                <div class="col-sm-10">
                                    <input class="form-control" value="{{old('user_rg')}}" name="user_rg" id="rg" type="text" placeholder="RG" maxlength="9">
                                    @if ($errors->has('user_rg'))
                                    <small class="text-danger" role="alert">
                                        <strong>{{ $errors->first('user_rg') }}</strong>
                                    </small>
                                     @endif
                                </div>
                    </div>
                    <input name="user_role" type="hidden" value="uset">

                    <div class="form-group row{{ $errors->has('user_cpf') ? ' has-error' : '' }}">
                        <label class="col-form-label col-sm-2" for="nome">CPF:</label>
                            <div class="col-sm-10">
                                <input class="form-control" value="{{old('user_cpf')}}" name="user_cpf" id="cpf" type="text" placeholder="CPF">
                                @if ($errors->has('user_cpf'))
                                <small class="text-danger" role="alert">
                                    <strong>{{ $errors->first('user_cpf') }}</strong>
                                </small>
                                @endif
                            </div>
                    </div>

                    <div class="form-group row{{ $errors->has('user_telefone') ? ' has-error' : '' }}">
                        <label class="col-form-label col-sm-2" for="telefone">Telefone:</label>
                            <div class="col-sm-10">
                                <input value="{{old('user_telefone')}}" class="form-control" name="user_telefone" id="telefone" type="text" placeholder="Telefone">
                                @if ($errors->has('user_telefone'))
                                <small class="text-danger" role="alert">
                                    <strong>{{ $errors->first('user_telefone') }}</strong>
                                </small>
                                @endif
                            </div>
                    </div>

                    <div class="form-group row{{ $errors->has('user_celular') ? ' has-error' : '' }}">
                            <label class="col-form-label col-sm-2" for="celular">Celular:</label>
                                <div class="col-sm-10">
                                    <input class="form-control" value="{{old('user_celular')}}" name="user_celular" id="celular" type="text" placeholder="Celular">
                                    @if ($errors->has('user_celular'))
                                    <small class="text-danger" role="alert">
                                        <strong>{{ $errors->first('user_celular') }}</strong>
                                    </small>
                                    @endif
                                </div>
                    </div>

                    <div class="form-group row">
                        <table style="margin-left: 202px">
                            <tr>
                                <td colspan="2"><label class="col-form-label" for="knowledge">Deseja ser mentor?</label></td>
                            </tr>
                            <tr>
                                <td><label><input type="radio" id="user_knowledege1" name="user_knowledge" class="radio-inline col-form-label" value="1"> Sim</label></td>
                                <td><label><input checked type="radio" id="user_knowledege2" name="user_knowledge" class="radio-inline col-form-label" value="0"> Não</label></td>
                            </tr>
                        </table>
                    </div>

                    <div class="form-group row"> 
                        <div style="margin-left: 980px">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-success">Cadastrar</button>
                                <a href="{{route('sair')}}" role="button" class="btn btn-warning">Sair</a>                    
                            </div>
                        </div>
                    </div>
                </form>
        </fieldset>
    </div>
        
        <script type="text/javascript">
            $(document).ready(function(){
               $("#rg").mask('99.999.999-9'); 
               $("#cpf").mask('999.999.999-99'); 
               $("#telefone").mask('(99) 9999-9999'); 
               $("#celular").mask('(99) 99999-9999', options);
            });
        </script>
</body>
@include('inc.feedback')                  
</html>