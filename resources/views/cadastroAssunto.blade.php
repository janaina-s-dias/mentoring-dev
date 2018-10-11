@extends('layouts.dashboard')
@section('page_heading','Perfil')
@section('section')
<script type="text/javascript">
    $(document).ready(function (){
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
            $('#btnEnviar').removeClass('hidden');
        }
        else
        {
            $('#btnEnviar').addClass('hidden');
        }
    });
});

</script>  
         <section class="arcus" style="height: 200px; padding: 55px 55px;">
             <?php $user = Session::get('user'); ?>
             <form method="POST" action="{{ route('usersubject.store')}}"> 
                <table class="table-responsive">
                <tr>
                    <th class="col-sm">
                        <label for="professionCombo">Profissão</label>
                    </th>
                    <th class="col-sm">
                        <label for="carrerCombo">Carreira</label>
                    </th>
                    <th class="col-sm">
                        <label for="subjectCombo">Assunto</label>
                    </th>
                    <td></td>
                </tr>
                <input type="hidden" name="fk_subject_user" value="{{ $user->user_id }}">
                <tr>
                    <th class="col-sm">
                        <select id="professionCombo">
                            <option value="">Carregando Profissão</option>
                        </select>           
                    </th>
                    <th class="col-sm">
                        <select id="carrerCombo">
                            <option value="">Carregando Carreira</option>
                        </select>
                    </th>
                    <th class="col-sm">
                        <select id="subjectCombo" name="fk_user_subject">
                            <option value=""> Carregando Assunto</option>
                        </select>
                    </th>
                    <th><input class="btn btn-primary" style = "display: none;" type="submit" name="Submit" value="Enviar" id="Submit"></th>
                </tr>
            </table>
            </form>
              
         </section>
            
@stop
