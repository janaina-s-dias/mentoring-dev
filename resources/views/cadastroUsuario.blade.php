<!DOCTYPE html>
<html>
    <head>
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
            <form class="form-horizontal" method="POST" action="{{ route('inserirUser') }}">
                @csrf
    <div class="form-group row">
        <label class="col-form-label col-sm-2" for="nome">Nome:</label>
            <div class="col-sm-10">
            <input class="form-control{{ $errors->has('user_nome') ? ' is-invalid' : '' }}"  value="{{old('user_nome')}}" name="user_nome" id="nome" type="text" placeholder="Nome">
            </div>
        @if ($errors->has('user_nome'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('user_nome') }}</strong>
            </span>
        @endif
        </div>
        <input type="hidden" value="{{ $user->user_id }}" name="user_id">
        <div class="form-group row">
            <label class="col-form-label col-sm-2" for="rg">RG:</label>
            <div class="col-sm-10">
                <input class="form-control{{ $errors->has('user_rg') ? ' is-invalid' : '' }}" value="{{old('user_rg')}}" name="user_rg" id="rg" type="number" placeholder="RG">
        
            @if ($errors->has('user_rg'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('user_rg') }}</strong>
            </span>
        @endif
        </div>
        </div>
        <input name="user_role" type="hidden" value="uset">
        <div class="form-group row">
            <label class="col-form-label col-sm-2" for="nome">CPF:</label>
            <div class="col-sm-10">
                <input class="form-control{{ $errors->has('user_cpf') ? ' is-invalid' : '' }}" value="{{old('user_cpf')}}" name="user_cpf" id="cpf" type="number" style="-moz-appearance:textfield;"placeholder="CPF">
            @if ($errors->has('user_cpf'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('user_cpf') }}</strong>
            </span>
        @endif
        </div>
        </div>
        <div class="form-group row">
            <label class="col-form-label col-sm-2" for="telefone">Telefone:</label>
            <div class="col-sm-10">
                <input value="{{old('user_telefone')}}" class="form-control{{ $errors->has('user_telefone') ? ' is-invalid' : '' }}" name="user_telefone" id="telefone" type="number" placeholder="Telefone">
            @if ($errors->has('user_telefone'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('user_telefone') }}</strong>
            </span>
        @endif
        </div>
            </div>
        <div class="form-group row">
            <label class="col-form-label col-sm-2" for="celular">Celular:</label>
        <div class="col-sm-10">
            <input class="form-control{{ $errors->has('user_celular') ? ' is-invalid' : '' }}" value="{{old('user_celular')}}" name="user_celular" id="celular" type="number" placeholder="Celular">
            @if ($errors->has('user_celular'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('user_celular') }}</strong>
            </span>
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
            <div style="margin-left: 1030px">
                <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>
        </div>
    </form>
    </div>
    </body>
@include('inc.feedback')
</html>