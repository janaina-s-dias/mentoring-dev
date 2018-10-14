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
             <?php $user = Session::get('user'); 
             //dd($user);
             ?>
             
             <form method="POST" action="{{ url('alterandoSenha',$user->user_id) }}" >
                 {{ csrf_field() }}

                <div class="form-group">
                    <input class="form-control{{ $errors->has('user_hash') ? ' has-error' : '' }}" name="user_hash" id="senha" type="password" placeholder="Senha Atual">
                </div>

                <div class="form-group">
                    <input class="form-control{{ $errors->has('user_hash') ? ' has-error' : '' }}" name="new_user_hash" id="novasenha" type="password" placeholder="Nova Senha">
                </div>

                <div class="form-group">
                    <input class="form-control{{ $errors->has('user_hash') ? ' has-error' : '' }}" name="new_user_hash_confirmation" id="confisenha" type="password" placeholder="Confirmação de Senha">

                </div> 

                <div class="form-group"> 
                    <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">Alterar Senha</button>
                    </div>
                </div>   
                
             </form>
              
         </section>  

         

            
@stop
