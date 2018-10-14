@extends('layouts.dashboardPerfil')
@section('page_heading','Alterar Senha')
@section('section')

         <section class="arcus" style="width: 550px; padding: 55px 55px;">
             <?php $user = Session::get('user'); 
                //dd($user);
                var_dump($user);
                
 
             ?>
             
             <form method="POST" action="{{ url('alterarSenha',$user->user_id) }}" >
                 @method('PATCH')
                 {{ csrf_field() }}

                <div class="form-group">
                    <input class="form-control{{ $errors->has('user_hash') ? ' is-invalid' : '' }}" name="user_hash" id="senha" type="password" placeholder="Senha Atual">
                </div>

                <div class="form-group">
                    <input class="form-control{{ $errors->has('user_hash') ? ' is-invalid' : '' }}" name="new_user_hash" id="novasenha" type="password" placeholder="Nova Senha">
                </div>

                <div class="form-group">
                    <input class="form-control{{ $errors->has('user_hash') ? ' is-invalid' : '' }}" name="new_user_hash_confirmation" id="confisenha" type="password" placeholder="Confirmação de Senha">

                </div> 

                <div class="form-group"> 
                    <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">Alterar Senha</button>
                    </div>
                </div>   
                
             </form>
              
         </section>  

         

            
@stop
