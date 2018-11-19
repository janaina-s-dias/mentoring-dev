@extends('layouts.dashboardPerfil')

@section('titlePage')
        
        <title>Cadastrar Conteúdo - Mentoring</title>

@stop  

@section('stylesPage')
        
        <link href="{{ asset('DashboardPerfil/DashboardPerfil.css') }}" rel="stylesheet" type="text/css"/>

@stop 

@section('scriptsPage')
     
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    
@stop


@section('section')
<script src="{{asset('assets/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        CKEDITOR.replace( 'editor', {
            width: '100%',
            height: 338,
            resize_enabled: false,
            language: 'pt',
            customConfig: "{{asset('assets/ckeditor/config.js')}}"
        });
        $.get("{{route('knowledge.show', Auth::user()->user_id)}}", function(data){
            var option = '';
            if(data.length > 0){
            $.each(data, function(i, linha) {
                 option+= "<option value='"+linha.mentor_id+"'>"+linha.assunto+"</option>";
            });
                $("#assunto").append(option).show();
           }
       }, 'json');
    });
</script>

<div class="content-ce-profile">
            
            <div class="content-ce-profile-header">                
                <h1>Cadastro de Conteúdo</h1>
            </div>                  
            
                           
<div class="content-ce-profile-cadassuntos"> 
            


        <form action="{{route('content.store')}}" method="POST" class="form-horizontal-profile">
        @csrf    
            <div class="form-group{{ $errors->has('fk_content_knowledge') ? ' has-error' : '' }}">
                <div class="form-group-profile">
                <label class="control-label-conteudo col-sm-2" for="assunto">Assunto:</label>
                <div class="col-sm-10">
                    <select class="form-control-conteudo" name="fk_content_knowledge" id="assunto">
                        <option value="">Selecione o assunto</option>
                    </select>
                    @if ($errors->has('fk_content_knowledge'))
                        <small class="text-danger" role="alert">
                            <strong>{{ $errors->first('fk_content_knowledge') }}</strong>
                        </small>
                    @endif
                </div>  
                </div>  
            </div>
            <div class="form-group{{ $errors->has('content_title') ? ' has-error' : '' }}">
                <div class="form-group-profile">
                <label class="control-label-conteudo col-sm-2" for="titulo">Titulo:</label>
                <div class="col-sm-10">
                    <input class="form-control-conteudo" type="text" name="content_title" id="titulo"/>
                    @if ($errors->has('fk_content_knowledge'))
                        <small class="text-danger" role="alert">
                            <strong>{{ $errors->first('content_title') }}</strong>
                        </small>
                    @endif
                </div>    
                </div>
            </div>
            <input type="hidden" class="form-control" name="content_type" value="1">
            <div class="form-group{{ $errors->has('content_content') ? ' has-error' : '' }}">
                <div class="form-group-profile">
                <label class="control-label-conteudo col-sm-2" for="conteudo">Conteudo:</label>
                <div class="col-sm-10-content">
                    <div class="textarea-content">
                    <textarea name="content_content" class="form-control-content" id="editor"></textarea>
                    </div>
                    @if ($errors->has('content_title'))
                        <small class="text-danger-content" role="alert">
                            <strong>{{ $errors->first('content_content') }}</strong>
                        </small>
                    @endif
                    <small class="text-content">Para adicionar conteudo direto no site, insirá-o acima</small>    
                    
                    <div class="col-sm-offset-2-conteudo col-sm-10">
                    <button class="btn-btn" id="submit">Cadastrar</button>
                    </div>

                </div>
                  
                </div>  
            </div>

        </form>
    
  

</div>

</div>


{{-- 1 é conteudo, 2 arquivo, 3 video, 4 url --}}
@include('inc.feedback')
<script>
$(document).ready(function(){
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
});
</script>           
            
@stop
