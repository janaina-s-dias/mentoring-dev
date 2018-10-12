@extends('layouts.dashboardPerfil')
@section('page_heading','Alterar Perfil')
@section('section')

         <section class="arcus" style="width: 550px; padding: 55px 55px;">

             <?php $user = Session::get('user'); ?>
             <form class="form-horizontal" method="POST" action=""> 
             
             <div class="form-group">
                  <label class="control-label col-sm-2" for="nome">Nome:</label>
                  <div class="col-sm-10">
                       <input class="form-control{{ $errors->has('user_nome') ? ' is-invalid' : '' }}" name="user_nome" id="nome" type="text" placeholder="Nome">
                  </div>
            
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="login">Login:</label>
                  <div class="col-sm-10">
                       <input class="form-control{{ $errors->has('user_login') ? ' is-invalid' : '' }}" name="user_login" id="login" type="text" placeholder="Login">
                  </div>
            
            </div>
            <div class="form-group">
                 <label class="control-label col-sm-2" for="rg">RG:</label>
                 <div class="col-sm-10">
                    <input class="form-control{{ $errors->has('user_rg') ? ' is-invalid' : '' }}" name="user_rg" id="rg" type="text" placeholder="RG"  pattern="\d{2}\.\d{3}\.\d{3}-\d{1}" title="No formato (##.###.###-#)">
                 </div>
            
            </div>

            <input name="user_role" type="hidden" value="cpf">
            <div class="form-group">
                 <label class="control-label col-sm-2" for="nome">CPF:</label>
                 <div class="col-sm-10">
                  <input class="form-control{{ $errors->has('user_cpf') ? ' is-invalid' : '' }}" name="user_cpf" id="cpf" type="text" placeholder="CPF" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="No formato (###.###.###-##)">
                 </div>
            
            </div>
            <div class="form-group">
                 <label class="control-label col-sm-2" for="telefone">Telefone:</label>
                 <div class="col-sm-10">
                     <input class="form-control{{ $errors->has('user_telefone') ? ' is-invalid' : '' }}" name="user_telefone" id="telefone" type="tel" placeholder="Telefone" 
                   pattern="[0-9]{2} [0-9]{4}-[0-9]{4}" title="No formato (## ####-####)">
                </div>
            
            </div>
            <div class="form-group">
                 <label class="control-label col-sm-2" for="celular">Celular:</label>
                 <div class="col-sm-10">
                <input class="form-control{{ $errors->has('user_celular') ? ' is-invalid' : '' }}" name="user_celular" id="celular" type="tel" placeholder="Celular"  
                   pattern="[0-9]{2} [0-9]{5}-[0-9]{4}" title="No formato (## #####-####)">
                </div>
            
            </div>
            <div class="form-group">
                 <label class="control-label col-sm-5" for="knowledge">Deseja ser mentor?</label>
                 <div class="col-sm-12" style="margin-left: 35px;">
                      <label><input type="radio" id="user_knowledege1" name="user_knowledege" class="radio-inline"> Sim</label>
                      <label><input type="radio" id="user_knowledege2" name="user_knowledege" class="radio-inline"> Não</label>
                 </div>
            </div>
            <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">Atualizar Cadastro</button>
            </div>
            </div>

                
             </form>
              
         </section>  

         

            
@stop
