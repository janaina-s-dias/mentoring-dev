@extends('layouts.dashboardPerfil')

@section('titlePage')
        
        <title>Alterar Senha - Mentoring</title>

@stop    

@section('stylesPage')
        
        <link href="{{ asset('DashboardPerfil/DashboardPerfil.css') }}" rel="stylesheet" type="text/css"/>

@stop 

@section('scriptsPage')
    
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    
@stop    


@section('section')

        <?php $user = Auth::user(); 
             //dd($user);
        ?>
        <div class="content-ce-profile">
            <div class="content-ce-profile-header">                
                <h1>Alterar Senha</h1>
            </div>                  
            
                           
            <div class="content-ce-profile-cadassuntos"> 
               
                <form class="form-horizontal-profile" method="POST" action="{{ url('alterandoSenha',$user->user_id) }}" >
                {{ csrf_field() }} 

                <div class="form-group{{ $errors->has('user_hash') ? ' has-error' : '' }}">
                    <div class="form-group-profile">
                    <label class="control-label-senha col-sm-4" for="lastsenha">Senha Antiga:</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="user_hash" id="lastsenha" type="password" placeholder="Senha Atual">
                    </div>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('user_hash') ? ' has-error' : '' }}">
                    <div class="form-group-profile">
                    <label class="control-label-senha col-sm-4" for="novasenha">Nova Senha:</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="new_user_hash" id="novasenha" type="password" placeholder="Nova Senha">
                    </div>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('user_hash') ? ' has-error' : '' }}">
                    <div class="form-group-profile">
                    <label class="control-label-senha col-sm-4" for="confisenha">Confimação:</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="new_user_hash_confirmation" id="confisenha" type="password" placeholder="Confirmação de Senha">
                    </div>
                    </div>
                </div> 

                <div class="form-group"> 
                    <div class="form-group-profile">
                    <div class="col-sm-offset-4-senha col-sm-8">
                    <button type="submit" class="btn btn-success">Alterar Senha</button>
                    </div>
                    </div>
                </div>   
                
             </form>
            

            </div>

     </div>    

         

            
@stop
