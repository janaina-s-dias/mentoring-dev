@extends('layouts.dashboardPerfil') 
@section('page_heading','')
@section('section')
@section ('table_panel_title','Editar Contato')
@section ('table_panel_body')
<section class="arcus" style="height: 200px; padding: 55px 55px;">
             <form id="formContato" method="POST" action="{{ route('contact.update', $contato->contact_id)}}" class="form-horizontal"> 
                 @method('PATCH')
                 @csrf
                    <div class="form-group{{ $errors->has('contact_type') ? ' has-error' : '' }}">
                        <label class="control-label col-sm-2" for="contactType">Tipo:</label>
                        <div class="col-sm-10">
                            <select id="contactType" name="contact_type" class="form-control">
                                <option value="">Selecione tipo de contato</option>
                                <option value="facebook" {{($contato->contact_type == 'facebook') ? ' selected' : ''}}>Facebook</option>
                                <option value="linkedin" {{($contato->contact_type == 'linkedin') ? ' selected' : ''}}>Linkedin</option>
                                <option value="email" {{($contato->contact_type == 'email') ? ' selected' : ''}}>Email</option>
                                <option value="skype" {{($contato->contact_type == 'skype') ? ' selected' : ''}}>Skype</option>
                                <option value="twitter" {{($contato->contact_type == 'twitter') ? ' selected' : ''}}>Twitter</option>
                                <option value="whatsapp" {{($contato->contact_type == 'whatsapp') ? ' selected' : ''}}>WhatsApp</option>
                                <option value="instagram" {{($contato->contact_type == 'instagram') ? ' selected' : ''}}>Instagram</option>
                                <option value="sitepessoal" {{($contato->contact_type == 'sitepessoal') ? ' selected' : ''}}>Site pessoal</option>
                                <option value="outro" {{($contato->contact_type == 'outro') ? ' selected' : ''}}>Outro</option>
                            </select>
                            @if ($errors->has('contact_type'))
                                <small class="text-danger" role="alert">
                                    <strong>{{ $errors->first('contact_type') }}</strong>
                                </small>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('contact_description') ? ' has-error' : ''}}">
                        <label class="control-label col-sm-2" for="contactDescription">Contato:</label>
                        <div class="col-sm-10">
                            <input id="contactDescription"  name="contact_description" class="form-control" value="{{$contato->contact_description}}"/>
                        @if ($errors->has('contact_description'))
                                <small class="text-danger" role="alert">
                                    <strong>{{ $errors->first('contact_description') }}</strong>
                                </small>
                        @endif
                        </div>
                    </div>
                    <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input class="btn btn-success" type="submit" name="Submit" value="Salvar" role="button" id="Submit">
                    </div>
                </div>
             </form>
              
         </section>
@include('inc.feedback')
@endsection
@include('widgets.panel', array('header'=>true, 'as'=>'table'))
@stop