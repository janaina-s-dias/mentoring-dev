@extends('layouts.dashboardPerfil')

@section('titlePage')
        
        <title>Cadastrar Assunto - Mentoring</title>

@stop  

@section('stylesPage')
        
        <link href="{{ asset('DashboardPerfil/DashboardPerfil.css') }}" rel="stylesheet" type="text/css"/>

@stop 

@section('scriptsPage')
     
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    
@stop


@section('section')
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
    if(!{{Auth::user()->user_knowledge}})
    {
        $('#mentorCombo').hide();
        $('#teste').hide();
    }
});

</script>  
        <?php $user = Session::get('user'); ?>
        <div class="content-ce-profile">
            <div class="content-ce-profile-header">                
                <h1>Cadastrar Assuntos</h1>
            </div>
            
            <div class="content-ce-profile-cadassuntos">                  
                 <form method="POST" action="{{ route('usersubject.store')}}" class="form-horizontal">
                 @csrf
                    <div class="form-group">
                        <div class="form-group-profile">
                        <label class="control-label-conteudo" for="professionCombo">Profissão:</label>
                        <div class="col-ce">
                            <select id="professionCombo" class="form-control-conteudo">
                                <option value="">Carregando Profissão</option>
                            </select>
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group-profile">
                        <label class="control-label-conteudo" for="carrerCombo">Carreira:</label>
                        <div class="col-ce">
                            <select id="carrerCombo" class="form-control-conteudo">
                                <option value="">Carregando Carreira</option>
                            </select>
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group-profile">
                        <label class="control-label-conteudo" for="subjectCombo">Assunto:</label>
                        <div class="col-ce">
                            <select id="subjectCombo" name="fk_user_subject" class="form-control-conteudo">
                                <option value=""> Carregando Assunto</option>
                            </select>
                            
                                <small class="text-danger" role="alert">
                                    <strong></strong>
                                </small>
                            
                        </div>
                        </div>
                    </div>                     
                 
                 <div class="form-group">
                    <div class="form-group-profile">
                    <label class="control-label-conteudo" id="teste" for="mentorCombo">Conhecimento:</label>
                    <div class="col-ce">
                        <select id="mentorCombo" name="knowledge_nivel" class="form-control-conteudo">
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
                 </div>

                 <div class="form-group-profile">
                 <input type="hidden" name="fk_subject_user" value="{{ Auth::user()->user_id }}">
                 <div class="form-group">
                    <div class="col-sm-conteudo col-sm-10">
                        <button class="btn btn-success btn-sm btn-circle" type="submit" name="Submit" id="Submit"><span class="glyphicon glyphicon-ok">Ok</span></button>
                    </div>
                 </div>
                 </div>
                 

                 </form>
            </div>

        </div>


@include('inc.feedback')
@stop
