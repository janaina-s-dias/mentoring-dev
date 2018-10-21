@extends('layouts.dashboardPerfil')
@section('page_heading','Cadastrar Assunto')
@section('section')
<script type="text/javascript">
$(document).ready(function (){
    jQuery('#formContato').submit(function(){
	var dados = jQuery(this).serialize();
	jQuery.ajax({
            type: "POST",
            url: "{{ route('contact.store')}}",
            data: dados,
            success: function( data )
            {
		limparForm();
            }
        });
	return false;
    });
    function limparForm()
    {
       $("#contactType").val('');
       $("#contactDescription").val(''); 
    }
});

</script>  
         <section class="arcus" style="height: 300px; padding: 55px 55px;">
             <form id="formContato" method="POST" action="" class="form-horizontal"> 
                @csrf
                    <div class="form-group{{ $errors->has('contact_type') ? ' has-error' : '' }}">
                        <label class="control-label col-sm-2" for="contactType">Tipo:</label>
                        <div class="col-sm-10">
                            <select id="contactType" name="contact_type" class="form-control">
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
                    <div class="form-group{{ $errors->has('contact_description') ? ' has-error' : ''}}">
                        <label class="control-label col-sm-2" for="contactDescription">Contato:</label>
                        <div class="col-sm-10">
                            <input id="contactDescription"  name="contact_description" class="form-control"/>
                        </div>
                        @if ($errors->has('contact_description'))
                                <small class="text-danger" role="alert">
                                    <strong>{{ $errors->first('contact_description') }}</strong>
                                </small>
                        @endif
                    </div>
                    <input type="hidden" name="fk_subject_user" value="{{ Auth::user()->user_id }}">
                    <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input class="btn btn-success" type="submit" name="Submit" value="Salvar" role="button" id="Submit">
                    </div>
                </div>
             </form>
              
         </section>
            @include('inc.feedback')
@stop
