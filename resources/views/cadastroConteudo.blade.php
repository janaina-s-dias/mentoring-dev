@extends('layouts.dashboardPerfil')
@section('page_heading','Conteudo')
@section('section')
<script src="{{asset('assets/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        CKEDITOR.replace( 'conteudo', {
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
            });
                $("#assunto").append(option).show();
           }
       }, 'json');
    });
</script>

  <ul class="nav nav-tabs">
    <li class="active"><a href="#conteudo">Conteudo</a></li>
    <li><a href="#arquivo">Arquivo</a></li>
    <li><a href="#video">Video</a></li>
    <li><a href="#link">Link</a></li>
  </ul>
  <div class="tab-content">
    <div id="conteudo" class="tab-pane fade in active">
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
                    <textarea name="content_content" class="form-control" id="conteudo"></textarea>
                    <small>Para adicionar conteudo direto no site, insirá-o acima</small>
                </div>    
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2">
                    <button class="btn btn-success" id="submit">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>
    <div id="arquivo" class="tab-pane fade">
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
                <div class="col-sm-offset-2">
                    <button class="btn btn-success" id="submit">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>
    <div id="video" class="tab-pane fade">
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
                <label class="control-label col-sm-2" for="url">URL:</label>
                <div class="col-sm-10">
                    <input type="url" class="form-control" name="content_urlLink" id="url"/>
                    <small>Para cadastrar um video, insira a url no campo acima.</small>
                </div>    
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2">
                    <button class="btn btn-success" id="submit">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>
    <div id="link" class="tab-pane fade">
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
            <div class="form-group">
            <input type="hidden" class="form-control" name="content_type" value="conteudo">
    <div class="form-group">
        <label class="control-label col-sm-2" for="arquivo">Arquivo:</label>
        <div class="col-sm-10">
            <input type="file" class="form-control"  name="content_urlArquivo" id="arquivo"/>
            <small>Para anexar um arquivo texto, selecion-o acima</small>
        </div>    
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="url">URL:</label>
        <div class="col-sm-10">
            <input type="url" class="form-control" name="content_urlLink" id="url"/>
            <small>Para cadastrar um video, insira a url no campo acima, para cadastrar um site, insira a url no campo acima</small>
        </div>    
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="conteudo">Conteudo:</label>
        <div class="col-sm-10">
            <textarea name="content_content" class="form-control" id="conteudo"></textarea>
            <small>Para adicionar conteudo direto no site, insirá-o acima</small>
        </div>    
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2">
            <button class="btn btn-success" id="submit">Cadastrar</button>
        </div>
    </div>
</form>

    </div>
  </div>

<script>
$(document).ready(function(){
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
});
</script>           
            
@stop
