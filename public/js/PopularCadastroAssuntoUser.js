$(document).ready(function (){
    $.getJSON("{{ route('usProfissao') }}", function(dados){
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
        $.getJSON("{{ route('usCarreira', $profissao)}}", function(dados){
            if (dados.length > 0){
                var option = "<option value=''>Selecione Carreira</option>"; 
                $.each(dados, function(i, obj){
                    option += "<option value='"+obj.carrer_id+"'>"+
                        obj.carrer_nome+"</option>";
                });
            }
        $("#carrerCombo").html(option).show();
         }); 
    });
    $('#carrerCombo').change(function (){
        var carreira = $('#carrerCombo').val();
        $.getJSON("{{ route('usAssunto', "+ carreira +") }}", function(dados){
            if (dados.length > 0){
                var option = "<option value=''>Selecione Assunto</option>"; 
                $.each(dados, function(i, obj){
                    option += "<option value='"+obj.subject_id+"'>"+
                        obj.subject_id+"</option>";
                });
            }
        $("#subjectCombo").html(option).show();
         }); 
    });