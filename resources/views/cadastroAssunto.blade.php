@extends('layouts.dashboard')
@section('page_heading','Perfil')
@section('section')
  
         <section class="arcus" style="height: 200px; padding: 55px 55px; background: #666666;">
             
            <div>    
            <label for="estado">Profissão</label>
            <select id="continent" onchange="comboDinamicaprof(this);">
            <option value="empty">Selecione uma Profissão</option>
            <option value="Profissão 1">Profissão 1</option>
            <option value="Profissão 2">Profissão 2</option>
            <option value="Profissão 3">Profissão 3</option>
            </select>
            <br/><br/>
            <label>Carreira</label>
            <select id="atributo1" onchange="comboDinamicacarrer(this);">
            <option value="0">Carreira</option>
            </select>
            <br/><br/>
            <label>Assunto</label>
            <select id="atributo2">
            <option value="0">Assunto</option>
            </select>
            </div>
              
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
         } 



        </script>

            
@stop
