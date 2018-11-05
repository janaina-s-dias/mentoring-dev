@extends('layouts.dashboardPerfil')

@section('titlePage')
        
        <title>Alterar Perfil - Mentoring</title>

@stop 

@section('stylesPage')
        
        <link href="{{ asset('DashboardPerfil/DashboardPerfil.css') }}" rel="stylesheet" type="text/css"/>

@stop 

@section('scriptsPage')
     
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    
@stop 


@section('section')
     
        </style>

        <?php $user = Auth::user(); ?> 
        <div class="content-ce-profile">
            <div class="content-ce-profile-header">                
                <h1>Alterar Perfil</h1>
            </div>

           <div class="content-ce-profile-cadassuntos"> 
            
            <form class="form-horizontal-profile-perfil" method="POST" action="{{ route('user.update', $user->user_id) }}"> 
            @method('PATCH')
            @csrf     
                <div class="box-lateral-conteudo">
                 <div class="box-lateral-perfil">
                 <div>
                    <div class="form-group{{ $errors->has('user_nome') ? ' has-error' : '' }}">
                      
                      <div class="form-group-profile">

                        <label class="control-label" for="nome">Nome:</label>
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

                    </div>                 
                 </div>

                 <div>
                    <div class="form-group{{ $errors->has('user_login') ? ' has-error' : '' }}">
                      
                      <div class="form-group-profile">

                        <label class="control-label" for="login">Login:</label>
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

                    </div>                 
                 </div>

                 <div>
                    <div class="form-group{{ $errors->has('user_email') ? ' has-error' : '' }}">
                      
                      <div class="form-group-profile">

                        <label class="control-label" for="emsil">Email:</label>
                        <div class="col-sm-10">
                             <input class="form-control" 
                                    name="user_email" id="emsil" type="text" placeholder="Email"
                                    value="{{ $user->user_email }}">
                            @if ($errors->has('user_rg'))
                             <small class="text-danger" role="alert">
                                    <strong>{{ $errors->first('user_email') }}</strong>
                             </small>
                            @endif
                        </div>                      

                      </div>

                    </div>                 
                 </div>

                 <div>
                    <div class="form-group{{ $errors->has('user_rg') ? ' has-error' : '' }}">
                      
                      <div class="form-group-profile">

                        <label class="control-label" for="RG">RG:</label>
                        <div class="col-sm-10">
                             <input class="form-control" 
                                    name="user_rg" id="rg" type="text" placeholder="RG"
                                    value="{{ $user->user_rg }}">
                            @if ($errors->has('user_cpf'))
                             <small class="text-danger" role="alert">
                                    <strong>{{ $errors->first('user_rg') }}</strong>
                             </small>
                            @endif
                        </div>                      

                      </div>

                    </div>                 
                 </div>
                 </div>

                 <div class="box-lateral-perfil">
                 <div>
                    <div class="form-group{{ $errors->has('user_cpf') ? ' has-error' : '' }}">
                      
                      <div class="form-group-profile">

                        <label class="control-label" for="cpf">CPF:</label>
                        <div class="col-sm-10">
                             <input class="form-control" 
                                    name="user_cpf" id="cpf" type="text" placeholder="CPF"
                                    value="{{ $user->user_cpf }}">
                            @if ($errors->has('user_telefone'))
                             <small class="text-danger" role="alert">
                                    <strong>{{ $errors->first('user_cpf') }}</strong>
                             </small>
                            @endif
                        </div>                      

                      </div>

                    </div>                 
                 </div>

                 <div>
                    <div class="form-group{{ $errors->has('user_telefone') ? ' has-error' : '' }}">
                      
                      <div class="form-group-profile">

                        <label class="control-label" for="telefone">Telefone:</label>
                        <div class="col-sm-10">
                             <input class="form-control" 
                                    name="user_telefone" id="telefone" type="text" placeholder="Telefone"
                                    value="{{ $user->user_telefone }}">
                            @if ($errors->has('user_telefone'))
                             <small class="text-danger" role="alert">
                                    <strong>{{ $errors->first('user_telefone') }}</strong>
                             </small>
                            @endif
                        </div>                      

                      </div>

                    </div>                 
                 </div>

                 <div>
                    <div class="form-group{{ $errors->has('user_celular') ? ' has-error' : '' }}">
                      
                      <div class="form-group-profile">

                        <label class="control-label" for="celular">Celular:</label>
                        <div class="col-sm-10">
                             <input class="form-control" 
                                    name="user_celular" id="celular" type="text" placeholder="Celular"
                                    value="{{ $user->user_celular }}">
                            @if ($errors->has('user_celular'))
                             <small class="text-danger" role="alert">
                                    <strong>{{ $errors->first('user_celular') }}</strong>
                             </small>
                            @endif
                        </div>                      

                      </div>

                    </div>                 
                 </div>
                 </div>
                </div>



                
            <div class="box-lateral-conteudo2">
                 <div class="form-group">
                    <table>
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
                   <div class="col-sm-offset-2-perfil col-sm-10">
                        <button type="submit" class="btn btn-success">Atualizar Cadastro</button>
                   </div>
                 </div>
            </div>
                
           </form>
           </div>


         </div>      

         
@include('inc.feedback')
            
@stop
