<div class="modal fade" id="myModal4">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" data-toggle="tooltip" title="Fechar">&times;</button>
        <h4 class="modal-title">Assunto</h4>
      </div>
      <div class="modal-body">
          <ul id="subjectsUsuario">
              
          </ul>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function (){
    function popularListaAssuntos(user)
{
         $('#myModall4').modal("show");
         $("#subjectsUsuario").empty();   
         $.get('/userassunto?user='+user, function(dados){
            if (dados.length > 0){
                var option = "<li><strong>Assuntos:</strong></li>"; 
                $.each(dados, function(i, obj){
                    option += "<li>"+
                        obj.subject_name+"</li>";
                });
            } else {
                $("#subjectsUsuario").empty();
                var option = "<li>Nenhum assunto</li>"; 
            }
            
            
        $("#subjectsUsuario").html(option).show();
         }); 
}
});
</script>