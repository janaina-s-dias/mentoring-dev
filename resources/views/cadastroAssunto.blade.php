@extends('layouts.dashboard')
@section('page_heading','Perfil')
@section('section')
<script type="text/javascript">
    $(document).ready(function (){
    $.getJSON("{{ route('usAssunto') }}", function(dados){
        if (dados.length > 0){
            
            var option = "<option value=''>Selecione Assunto</option>"; 
            $.each(dados, function(i, obj){
                option += "<option value='"+obj.subject_id+"'>"+
                    obj.subject_nome+"</option>";
            });
        }
        $("#subjectCombo").html(option).show();
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
                    <!--<th class="col-sm">
                        <label for="professionCombo">Profissão</label>
                    </th>
                    <th class="col-sm">
                        <label for="carrerCombo">Carreira</label>
                    </th>-->
                    <th class="col-sm">
                        <label for="subjectCombo">Assunto</label>
                    </th>
                    <td></td>
                </tr>
                <input type="hidden" name="fk_subject_user" value="{{ $user->user_id }}">
                <tr>
                    <!-- <th class="col-sm">
                        <select id="professionCombo">
                            <option value="">Carregando Profissão</option>
                        </select>           
                    </th>
                    <th class="col-sm">
                        <select id="carrerCombo">
                            <option value="">Carregando Carreira</option>
                        </select>
                    </th>-->
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

         <script type="text/javascript">
          
          var profLists = new Array(10) 

          profLists["empty"] = ["Carreira"]; 
          profLists["Profissão 1"] = ["Carreira 1", "Carreira 2", "Carreira 3", "Carreira 4"]; 
          profLists["Profissão 2"] = ["Carreira 1", "Carreira 2", "Carreira 3", "Carreira 4", "Carreira 5"]; 
          profLists["Profissão 3"] = ["Carreira 1", "Carreira 2", "Carreira 3", "Carreira 4", "Carreira 5", "Carreira 6", "Carreira 7"];

          
          var carrerLists = new Array(10) 

          carrerLists["empty"] = ["Assunto"]; 
          carrerLists["Carreira 1"] = ["Assunto 1", "Assunto 2", "Assunto 3", "Assunto 4"]; 
          carrerLists["Carreira 2"] = ["Assunto 1", "Assunto 2", "Assunto 3", "Assunto 4", "Assunto 5"]; 
          carrerLists["Carreira 3"] = ["Assunto 1", "Assunto 2", "Assunto 3", "Assunto 4", "Assunto 5", "Assunto 6", "Assunto 7"];
          carrerLists["Carreira 4"] = ["Assunto 1", "Assunto 2", "Assunto 3", "Assunto 4", "Assunto 5", "Assunto 6", "Assunto 7"]; 
          carrerLists["Carreira 5"] = ["Assunto 1", "Assunto 2", "Assunto 3", "Assunto 4", "Assunto 5", "Assunto 6", "Assunto 7"]; 
          carrerLists["Carreira 6"] = ["Assunto 1", "Assunto 2", "Assunto 3", "Assunto 4", "Assunto 5", "Assunto 6", "Assunto 7"];
          carrerLists["Carreira 7"] = ["Assunto 1", "Assunto 2", "Assunto 3", "Assunto 4", "Assunto 5", "Assunto 6", "Assunto 7"];
          

         function comboDinamicaprof(selectObj) { 
         // get the index of the selected option 
         var idx = selectObj.selectedIndex; 
         // get the value of the selected option 
         var which = selectObj.options[idx].value; 
         // use the selected option value to retrieve the list of items from the countryLists array 
         cList = profLists[which]; 
         // get the country select element via its known id 
         var cSelect = document.getElementById("atributo1"); 
         // remove the current options from the country select 
         var len=cSelect.options.length; 
         while (cSelect.options.length > 0) { 
               cSelect.remove(0); 
         }

         deleteDinamic();

         
         var newOption; 
         // create new options 
         for (var i=0; i<cList.length; i++) { 
         newOption = document.createElement("option"); 
         newOption.value = cList[i];  // assumes option string and value are the same 
         newOption.text=cList[i]; 
         // add the new option 
         try { 
             cSelect.add(newOption);  // this will fail in DOM browsers but is needed for IE 
         } 
         catch (e) { 
             cSelect.appendChild(newOption); 
         } 
         }

         document.getElementById("sub").style.visibility = "hidden";

         } 


         function deleteDinamic(){
           
         var cSelect3 = document.getElementById("atributo2"); 
         
            if(cSelect3.options.length > 0){

              // remove the current options from the country select 
              var len=cSelect3.options.length; 
              while (cSelect3.options.length > 0) { 
                    cSelect3.remove(0);

            }

         }
         }


         function comboDinamicacarrer(selectObj) { 
         // get the index of the selected option 
         var idx2 = selectObj.selectedIndex; 
         // get the value of the selected option 
         var which2 = selectObj.options[idx2].value; 
         // use the selected option value to retrieve the list of items from the countryLists array 
         cList2 = carrerLists[which2]; 
         // get the country select element via its known id 
         var cSelect2 = document.getElementById("atributo2"); 
         // remove the current options from the country select 
         var len2=cSelect2.options.length; 
         while (cSelect2.options.length > 0) { 
               cSelect2.remove(0); 
         } 
         
         var newOption2; 
         // create new options 
         for (var i=0; i<cList2.length; i++) { 
         newOption2 = document.createElement("option"); 
         newOption2.value = cList2[i];  // assumes option string and value are the same 
         newOption2.text=cList2[i]; 
         // add the new option 
         try { 
             cSelect2.add(newOption2);  // this will fail in DOM browsers but is needed for IE 
         } 
         catch (e) { 
             cSelect2.appendChild(newOption2); 
         } 
         }
         
          document.getElementById("sub").style.visibility = "visible";

         } 



        </script>

            
@stop
