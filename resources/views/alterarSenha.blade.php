@extends('layouts.dashboardPerfil')
@section('page_heading','Alterar Senha')
@section('section')


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
        
         <section class="arcus" style="width: 550px; padding: 55px 55px;">
                <?php $user = Auth::user(); 
             //dd($user);
             ?>
             
             <form class="form-horizontal" method="POST" action="{{ url('alterandoSenha',$user->user_id) }}" >
                 {{ csrf_field() }}

                <div class="form-group{{ $errors->has('user_hash') ? ' has-error' : '' }}">
                    <label class="control-label col-sm-4" for="lastsenha">Senha Antiga:</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="user_hash" id="lastsenha" type="password" placeholder="Senha Atual">
                    </div>
                </div>

                <div class="form-group{{ $errors->has('user_hash') ? ' has-error' : '' }}">
                    <label class="control-label col-sm-4" for="novasenha">Nova Senha:</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="new_user_hash" id="novasenha" type="password" placeholder="Nova Senha">
                    </div>
                </div>

                <div class="form-group{{ $errors->has('user_hash') ? ' has-error' : '' }}">
                    
                    <label class="control-label col-sm-4" for="confisenha">Confimação:</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="new_user_hash_confirmation" id="confisenha" type="password" placeholder="Confirmação de Senha">
                    </div>
                </div> 

                <div class="form-group"> 
                    <div class="col-sm-offset-4 col-sm-8">
                    <button type="submit" class="btn btn-success">Alterar Senha</button>
                    </div>
                </div>   
                
             </form>
              
         </section>  

         

            
@stop
