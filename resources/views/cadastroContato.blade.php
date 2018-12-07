@extends('layouts.dashboardPerfil')

@section('titlePage')

        <title>Cadastrar Contato - Mentoring</title>

@stop

@section('stylesPage')

        <link href="{{ asset('DashboardPerfil/DashboardPerfil.css') }}" rel="stylesheet" type="text/css"/>

@stop

@section('scriptsPage')

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

@stop


@section('section')

         <div class="content-ce-profile">
            <div class="content-ce-profile-header">
                <h1>Cadastro de Contatos</h1>
            </div>


            <div class="content-ce-profile-cadassuntos">

                <form id="formContato" method="POST" action="{{ route('contact.store')}}" class="form-horizontal-profile">
                @csrf
                    <div class="form-group{{ $errors->has('contact_type') ? ' has-error' : '' }}">
                        <div class="form-group-profile">
                        <label class="control-label-conteudo col-sm-2" for="contactType">Tipo:</label>
                        <div class="col-sm-10">
                            <select id="contactType" name="contact_type" class="form-control-conteudo">
                                <option value="">Selecione tipo de contato</option>
                                <option value="facebook">Facebook</option>
                                <option value="linkedin">Linkedin</option>
                                <option value="email">Email</option>
                                <option value="skype">Skype</option>
                                <option value="twitter">Twitter</option>
                                <option value="whatsapp">WhatsApp</option>
                                <option value="instagram">Instagram</option>
                                <option value="sitepessoal">Site pessoal</option>
                                <option value="outro">Outro</option>
                            </select>
                            @if ($errors->has('contact_type'))
                                <small class="text-danger" role="alert">
                                    <strong>{{ $errors->first('contact_type') }}</strong>
                                </small>
                            @endif
                        </div>
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('contact_description') ? ' has-error' : ''}}">
                        <div class="form-group-profile">
                        <label class="control-label-conteudo col-sm-2" for="contactDescription">Contato:</label>
                        <div class="col-sm-10">
                            <input id="contactDescription"  name="contact_description" class="form-control-conteudo"/>
                            @if ($errors->has('contact_description'))
                                <small class="text-danger" role="alert">
                                    <strong>{{ $errors->first('contact_description') }}</strong>
                                </small>
                            @endif
                        </div>
                        </div>
                    </div>

                    <div class="form-group-profile">
                    <input type="hidden" name="fk_contact_user" value="{{ Auth::user()->user_id }}">
                    <div class="form-group">
                    <div class="col-sm-conteudo col-sm-16">
                        <input class="btn-btn" type="submit" name="Submit" value="Salvar" role="button" id="Submit">
                    </div>
                    </div>
                    </div>

             </form>


            </div>

     </div>


@include('inc.feedback')
@stop
