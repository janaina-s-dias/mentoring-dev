@extends('layouts.dashboardPerfil')
@section('page_heading','Cadastrar Assunto')
@section('section')
@php 
    $user = Session::get('user');
@endphp
<script type="text/javascript">
    $(document).ready(function (){
        $('#Submit').hide();
    $.get('/profissao', function(dados){
        if (dados.length > 0){
            
            var option = "<option value=''>Selecione Profissão</option>"; 
            $.each(dados, function(i, obj){
                option += "<option value='"+obj.profession_id+"'>"+
                    obj.profession_nome+"</option>";
            });
        }
        $("#professionCombo").html(option).show();
    });
    
    $('#professionCombo').change(function (){
        $('#Submit').hide();
        var profissao = $('#professionCombo').val();
        $.get('/carreira?profissao='+profissao, function(dados){
            if (dados.length > 0){
                var option = "<option value=''>Selecione Carreira</option>"; 
                $.each(dados, function(i, obj){
                    option += "<option value='"+obj.carrer_id+"'>"+
                        obj.carrer_nome+"</option>";
                });
                 
            } else {
                $("#carrerCombo").empty();
                var option = "<option value=''>Carregando Carreira</option>";
                $("#subjectCombo").empty();
                var optionSubject = "<option value=''>Carregando Assunto</option>";
                $("#subjectCombo").html(optionSubject).show();
            }
        $("#carrerCombo").html(option).show();
         }); 
    });
    $('#carrerCombo').change(function (){
        $('#Submit').hide();
        var carreira = $('#carrerCombo').val();
         $.get('/assunto?carreira='+carreira, function(dados){
            if (dados.length > 0){
                var option = "<option value=''>Selecione Assunto</option>"; 
                $.each(dados, function(i, obj){
                    option += "<option value='"+obj.subject_id+"'>"+
                        obj.subject_nome+"</option>";
                });
            } else {
                $("#subjectCombo").empty();
                var option = "<option value=''>Carregando Assunto</option>"; 
            }
            
            
        $("#subjectCombo").html(option).show();
         }); 
    });
    $('#subjectCombo').change(function (){
        if($(this).val() != '')
        {
            $('#Submit').show();
        }
        else
        {
            $('#Submit').hide();
        }
    });
    if(!{{$user->user_knowledge}})
    {
        $('#mentorCombo').hide();
    }
});

</script>  
         <section class="arcus" style="height: 300px; padding: 55px 55px;">
             <?php $user = Session::get('user'); ?>
             <form method="POST" action="{{ route('usersubject.store')}}" class="form-horizontal"> 
                @csrf
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="professionCombo">Profissão:</label>
                        <div class="col-sm-10">
                            <select id="professionCombo" class="form-control">
                                <option value="">Carregando Profissão</option>
                            </select>           
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="carrerCombo">Carreira:</label>
                        <div class="col-sm-10">
                            <select id="carrerCombo" class="form-control">
                                <option value="">Carregando Carreira</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="subjectCombo">Assunto:</label>
                        <div class="col-sm-10">
                            <select id="subjectCombo" name="fk_user_subject" class="form-control">
                                <option value=""> Carregando Assunto</option>
                            </select>
                            @if ($errors->has('fk_user_subject'))
                                <small class="text-danger" role="alert">
                                    <strong>{{ $errors->first('fk_user_subject') }}</strong>
                                </small>
                            @endif
                        </div>
                    </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="mentorCombo">Conhecimento:</label>
                    <div class="col-sm-10">
                        <select id="mentorCombo" name="knowledge_nivel" class="form-control">
                            <option value="1">Basico</option>
                            <option value="2">Pouco conhecimento</option>
                            <option value="3">Conhecimento mediano</option>
                            <option value="4">Conhecimento quase pleno</option>
                            <option value="5">Conhecimento pleno</option>
                            <option value="6">Bastante conhecimento</option>
                            <option value="7">Experiente no assunto</option>
                            <option value="8">Mestre no assunto</option>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="fk_subject_user" value="{{ $user->user_id }}">
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button class="btn btn-success btn-sm btn-circle" type="submit" name="Submit" id="Submit"><span class="glyphicon glyphicon-ok"></span></button>
                    </div>
                </div>
             </form>
              
         </section>
            @include('inc.feedback')
@stop
