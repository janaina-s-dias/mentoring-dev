@extends('layouts.dashboardPerfil')
@section('page_heading','Conteudo')
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
                 option+= "<option value='"+linha.assunto_id+"'>"+linha.assunto+"</option>";
                 //no value ser o id do knowledge e não do assunto
            });
                $("#assunto").append(option).show();
           }
       }, 'json');
    });
</script>

  <ul class="nav nav-tabs">
    <li class="active"><a href="#conteudo">Conteudo</a></li>
{{--    <li><a href="#arquivo">Arquivo</a></li> --}}
  </ul>
  <div class="tab-content">
    <div id="conteudo" class="tab-pane fade in active">
        <br/>
        <br/>
        <form action="{{route('content.store')}}" method="POST" class="form-horizontal">
            <div class="form-group">
                <label class="control-label col-sm-2" for="assunto">Assunto:</label>
                <div class="col-sm-10">
                    <select class="form-control" name="fk_content_knowledge" id="assunto">
                        <option value="">Selecione o assunto</option>
                    </select>
                </div>    
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="titulo">Titulo:</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="content_title" id="titulo"/>
                </div>    
            </div>
            <input type="hidden" class="form-control" name="content_type" value="conteudo">
            <div class="form-group">
                <label class="control-label col-sm-2" for="conteudo">Conteudo:</label>
                <div class="col-sm-10">
                    <textarea name="content_content" class="form-control" id="editor"></textarea>
                    <small>Para adicionar conteudo direto no site, insirá-o acima</small>
                </div>    
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button class="btn btn-success" id="submit">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>
    {{-- <div id="arquivo" class="tab-pane fade">
        <br/>
        <br/>
        <form action="{{route('content.store')}}" method="POST" class="form-horizontal">
            <div class="form-group">
                <label class="control-label col-sm-2" for="assunto">Assunto:</label>
                <div class="col-sm-10">
                    <select class="form-control" name="fk_content_knowledge" id="assunto">
                        <option value="">Selecione o assunto</option>
                    </select>
                </div>    
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="titulo">Titulo:</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="content_title" id="titulo"/>
                </div>    
            </div>
            <input type="hidden" class="form-control" name="content_type" value="arquivo">
            <div class="form-group">
                <label class="control-label col-sm-2" for="arquivo">Arquivo:</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control"  name="content_urlArquivo" id="arquivo"/>
                    <small>Para anexar um arquivo texto, selecion-o acima</small>
                </div>    
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2  col-sm-10">
                    <button class="btn btn-success" id="submit">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>
  </div>--}}

<script>
$(document).ready(function(){
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
});
</script>           
            
@stop
