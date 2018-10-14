@extends('layouts.dashboard')
@section('page_heading','Perfil')
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
});

</script>  
         <section class="arcus" style="height: 200px; padding: 55px 55px;">
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
