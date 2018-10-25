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
                 option+= "<option value='"+linha.mentor_id+"'>"+linha.assunto+"</option>";
            });
                $("#assunto").append(option).show();
           }
       }, 'json');
    });
</script>

  <ul class="nav nav-tabs">
    <li class="active"><a href="#conteudo">Conteudo</a></li>
  </ul>
  <div class="tab-content">
    <div id="conteudo" class="tab-pane fade in active">
        <br/>
        <br/>
        <form action="{{route('content.store')}}" method="POST" class="form-horizontal">
            @csrf
            <div class="form-group{{ $errors->has('fk_content_knowledge') ? ' has-error' : '' }}">
                <label class="control-label col-sm-2" for="assunto">Assunto:</label>
                <div class="col-sm-10">
                    <select class="form-control" name="fk_content_knowledge" id="assunto">
                        <option value="">Selecione o assunto</option>
                    </select>
                    @if ($errors->has('fk_content_knowledge'))
                        <small class="text-danger" role="alert">
                            <strong>{{ $errors->first('fk_content_knowledge') }}</strong>
                        </small>
                    @endif
                </div>    
            </div>
            <div class="form-group{{ $errors->has('content_title') ? ' has-error' : '' }}">
                <label class="control-label col-sm-2" for="titulo">Titulo:</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="content_title" id="titulo"/>
                    @if ($errors->has('content_title'))
                        <small class="text-danger" role="alert">
                            <strong>{{ $errors->first('content_title') }}</strong>
                        </small>
                    @endif
                </div>    
            </div>
            <input type="hidden" class="form-control" name="content_type" value="1">
            <div class="form-group{{ $errors->has('content_content') ? ' has-error' : '' }}">
                <label class="control-label col-sm-2" for="conteudo">Conteudo:</label>
                <div class="col-sm-10">
                    <textarea name="content_content" class="form-control" id="editor"></textarea>
                    <small>Para adicionar conteudo direto no site, insirá-o acima</small>
                    @if ($errors->has('content_content'))
                        <small class="text-danger" role="alert">
                            <strong>{{ $errors->first('content_content') }}</strong>
                        </small>
                    @endif
                </div>    
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button class="btn btn-success" id="submit">Cadastrar</button>
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
