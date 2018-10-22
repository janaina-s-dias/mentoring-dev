@extends('layouts.dashboard')
@section('page_heading','Conteudo')
@section('section')
<script src="{{asset('assets/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        esconde();
        function esconde(){
            $("#url").hide();
            $("#arquivo").hide();
            $("#conteudo").hide();
            $("#titulo").hide();
            $("#tipo").hide();
            $("#submit").hide();
        }
        $("#assunto").on('change', function(){
           $("#url").hide();
           $("#arquivo").hide();
           $("#conteudo").hide();
           $("#titulo").show();
           $("#tipo").show();
        });
        $("#tipo").on('change', function() {
            $("#url").hide();
            $("#arquivo").hide();
            $("#conteudo").hide();
            $("#titulo").show();
            $("#tipo").show();
            if($(this).val() === 1) {
                $("#arquivo").show();
                $("#submit").show();
            }
            else if($(this).val() === 2) {       
                $("#url").show();
                $("#submit").show();
            } else if ($(this).val() === 3) {
                $("#url").show();
                $("#submit").show();
                }
            else if($(this).val() === 4) {
                $("#conteudo").show();
                $("#submit").show();
                CKEDITOR.replace( 'conteudo', {
                    width: '100%',
                    height: 338,
                    resize_enabled: false,
                    language: 'pt',
                    customConfig: "{{asset('assets/ckeditor/config.js')}}"
                });
            }
            else {
                $("#url").hide();
                $("#arquivo").hide();
                $("#conteudo").hide();
            }
        });
        $.get("{{route('knowledge.show', Auth::user()->user_id)}}", function(data){
            var option = '';
            if(data.length > 0){
            $.each(data, function(i, linha) {
                 option+= "<option value='"+linha.assunto_id+"'>"+linha.assunto+"</option>";
            });
                $("#assunto").append(option).show();
           }
       }, 'json');
    });
</script>

<form action="{{route('content.store')}}" method="POST" class="form-horizontal">
    <div class="form-group">
        <label class="control-label col-sm-2" for="assunto">Assunto:</label>
        <div class="col-sm-10">
            <select name="fk_content_knowledge" id="assunto">
                <option value="">Selecione o assunto</option>
            </select>
        </div>    
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="titulo">Titulo:</label>
        <div class="col-sm-10">
            <input type="text" name="content_title" id="titulo"/>
        </div>    
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="tipo">Tipo:</label>
        <div class="col-sm-10">
            <select name="content_type" id="tipo">
                <option value="">Selecione o tipo</option>
                <option value="1">Arquivo</option>
                <option value="2">Video</option>
                <option value="3">Link</option>
                <option value="4">Conteudo</option>
            </select>
        </div>    
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="arquivo">Arquivo:</label>
        <div class="col-sm-10">
            <input type="file" name="content_urlArquivo" id="arquivo"/>
        </div>    
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="url">URL:</label>
        <div class="col-sm-10">
            <input type="url" name="content_urlLink" id="url"/>
        </div>    
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="conteudo">Conteudo:</label>
        <div class="col-sm-10">
            <textarea name="content_content" id="conteudo"></textarea>
        </div>    
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2">
            <button class="btn btn-success" id="submit">Cadastrar</button>
        </div>
    </div>
</form>
           
            
@stop
