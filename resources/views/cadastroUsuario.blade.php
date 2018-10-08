<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="{{ asset('js/jquery.mask.js') }}"></script>
    </head>
    <body>
        <div class="container" style="margin-top: 50px">
            <form class="form-horizontal" method="POST" action="{{ route('atualizarUsuario') }}">
    <div class="form-group">
        <label class="control-label col-sm-2" for="nome">Nome:</label>
            <div class="col-sm-10">
            <input class="form-control{{ $errors->has('user_nome') ? ' is-invalid' : '' }}" name="user_nome" id="nome" type="text" placeholder="Nome">
            </div>
            @if ($errors->has('user_nome'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('user_nome') }}</strong>
            </span>
        @endif
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="rg">RG:</label>
            <div class="col-sm-10">
            <input class="form-control{{ $errors->has('user_rg') ? ' is-invalid' : '' }}" name="user_rg" id="rg" type="text" placeholder="RG"  pattern="\d{2}\.\d{3}\.\d{3}-\d{1}" title="No formato (##.###.###-#)">
        </div>
            @if ($errors->has('user_rg'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('user_rg') }}</strong>
            </span>
        @endif
        </div>
        <input name="user_role" type="hidden" value="cpf">
        <div class="form-group">
            <label class="control-label col-sm-2" for="nome">CPF:</label>
            <div class="col-sm-10">
            <input class="form-control{{ $errors->has('user_cpf') ? ' is-invalid' : '' }}" name="user_cpf" id="cpf" type="text" placeholder="CPF" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="No formato (###.###.###-##)">
        </div>
            @if ($errors->has('user_cpf'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('user_cpf') }}</strong>
            </span>
        @endif
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="telefone">Telefone:</label>
            <div class="col-sm-10">
            <input class="form-control{{ $errors->has('user_telefone') ? ' is-invalid' : '' }}" name="user_telefone" id="telefone" type="tel" placeholder="Telefone" 
                   pattern="[0-9]{2} [0-9]{4}-[0-9]{4}" title="No formato ((##) ####-####)">
        </div>
            @if ($errors->has('user_telefone'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('user_telefone') }}</strong>
            </span>
        @endif
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="celular">Celular:</label>
        <div class="col-sm-10">
            <input class="form-control{{ $errors->has('user_celular') ? ' is-invalid' : '' }}" name="user_celular" id="celular" type="tel" placeholder="Celular"  
                   pattern="[0-9]{2} [0-9]{5}-[0-9]{4}" title="No formato ((##) #####-####)">
        </div>
            @if ($errors->has('user_celular'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('user_celular') }}</strong>
            </span>
        @endif
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="knowledge">Deseja ser mentor?</label>
            <div class="col-sm-12">
                <label><input type="radio" id="user_knowledege1" name="user_knowledege" class="radio-inline"> Sim</label>
                <label><input type="radio" id="user_knowledege2" name="user_knowledege" class="radio-inline"> Não</label>
            </div>
        </div>
        <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>
        </div>
    </form>
    </div>
    </body>
@include('inc.feedback')
</html>