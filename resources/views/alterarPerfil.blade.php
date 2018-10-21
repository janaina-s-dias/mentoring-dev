@extends('layouts.dashboardPerfil')
@section('page_heading','Alterar Perfil')
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

            <?php $user = Auth::user(); ?>
            <form class="form-horizontal" method="POST" action="{{ route('user.update', $user->user_id) }}"> 
                 @method('PATCH')
                 @csrf
             <div class="form-group{{ $errors->has('user_nome') ? ' has-error' : '' }}">
                  <label class="control-label col-sm-2" for="nome">Nome:</label>
                  <div class="col-sm-10">
                       <input class="form-control" 
                              name="user_nome" id="nome" type="text" placeholder="Nome"
                              value="{{ $user->user_nome }}">
                       @if ($errors->has('user_nome'))
                        <small class="text-danger" role="alert">
                            <strong>{{ $errors->first('user_nome') }}</strong>
                        </small>
                        @endif
                       </div>
            </div>
            
        
            <div class="form-group{{ $errors->has('user_login') ? ' has-error' : '' }}">
                <label class="control-label col-sm-2" for="login">Login:</label>
                  <div class="col-sm-10">
                    <input class="form-control" 
                           name="user_login" id="login" type="text" placeholder="Login"
                           value="{{ $user->user_login }}">
                     @if ($errors->has('user_login'))
                        <small class="text-danger" role="alert">
                            <strong>{{ $errors->first('user_login') }}</strong>
                        </small>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('user_email') ? ' has-error' : '' }}">
                <label class="control-label col-sm-2" for="emsil">Email:</label>
                  <div class="col-sm-10">
                      <input class="form-control" 
                             name="user_email" id="emsil" type="text" placeholder="Email"
                             value="{{ $user->user_email }}">
                      @if ($errors->has('user_email'))
                        <small class="text-danger" role="alert">
                            <strong>{{ $errors->first('user_email') }}</strong>
                        </small>
                     @endif
                  </div>
            </div>
            
        
            <div class="form-group{{ $errors->has('user_rg') ? ' has-error' : '' }}">
                 <label class="control-label col-sm-2" for="rg">RG:</label>
                 <div class="col-sm-10">
                     <input class="form-control" 
                            name="user_rg" id="rg" type="number" placeholder="RG"
                            value="{{ $user->user_rg }}">
                         @if ($errors->has('user_rg'))
                                <strong>{{ $errors->first('user_rg') }}</strong>
                            </small>
                        @endif
                 </div>
                 
            </div>

        
            <div class="form-group{{ $errors->has('user_cpf') ? ' has-error' : '' }}">
                 <label class="control-label col-sm-2" for="nome">CPF:</label>
                 <div class="col-sm-10">
                     <input class="form-control" 
                            name="user_cpf" id="cpf" type="number" placeholder="CPF"
                            value="{{ $user->user_cpf }}">
                            @if ($errors->has('user_cpf'))
                                <small class="text-danger" role="alert" style="margin-left: 95px">
                                    <strong>{{ $errors->first('user_cpf') }}</strong>
                                </small>
                            @endif
                 </div>
            </div>
        
            <div class="form-group{{ $errors->has('user_telefone') ? ' has-error' : '' }}">
                 <label class="control-label col-sm-2" for="telefone">Telefone:</label>
                <div class="col-sm-10">
                     <input class="form-control"
                            name="user_telefone" id="telefone" type="number" placeholder="Telefone"
                            value="{{ $user->user_telefone }}">
                            @if ($errors->has('user_telefone'))
                                <small class="text-danger" role="alert" style="margin-left: 95px">
                                    <strong>{{ $errors->first('user_telefone') }}</strong>
                                </small>
                            @endif
                </div>
            </div>
        
            <div class="form-group{{ $errors->has('user_celular') ? ' has-error' : '' }}">
                <label class="control-label col-sm-2" for="celular">Celular:</label>
                <div class="col-sm-10">
                <input class="form-control" 
                       name="user_celular" id="celular" type="number" placeholder="Celular"
                       value="{{ $user->user_celular }}">
                        @if ($errors->has('user_celular'))
                            <small class="text-danger" role="alert">
                                <strong>{{ $errors->first('user_celular') }}</strong>
                            </small>
                        @endif
                </div>
            </div>
            <div class="form-group">
                <table style="margin-left: 95px">
                    <tr>
                        <td colspan="2"><label class="col-form-label" for="knowledge">Deseja ser mentor?</label></td>
                    </tr>
                    <tr>
                        <td><label><input type="radio" id="user_knowledege1" name="user_knowledge" 
                                          class="radio-inline col-form-label" value="1"
                                          {{($user->user_knowledge == 1) ? 'checked' : ''}}> Sim</label></td>
                        <td><label><input type="radio" id="user_knowledege2" name="user_knowledge" 
                                          class="radio-inline col-form-label" value="0"
                                          {{($user->user_knowledge == 0) ? 'checked' : ''}}> Não</label></td>
                    </tr>
                </table>
              </div>
            <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">Atualizar Cadastro</button>
            </div>
            </div>

                
             </form>
              
         </section>  

         
@include('inc.feedback')
            
@stop
