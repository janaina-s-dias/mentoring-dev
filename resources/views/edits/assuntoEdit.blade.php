@extends('layouts.dashboardAdmin') 
@section('page_heading','')
@section('section')
@section ('table_panel_title','Editar Assunto')
@section ('table_panel_body')

<?php 
                if(Session::exists('assunto'))
                {
                    $subject = Session::get('assunto');
                }
                else
                {
                    $dados = array();
                    $dados['subject_id'] = '';
                    $dados['subject_name'] = '';
                    Session::put('assunto', $dados);
                    $subject = Session::get('assunto');
                }
          ?>
          <form role="form" method="POST" action="{{route('subject.update', $subject['subject_id']) }}">
              @method('PATCH')
              @csrf
            <div class="form-group">
                <label>Profissão</label>
                <select class="form-control" id="profissaoCombo"> 
                    <option value="">Carregando Profissões</option>
                </select>
            </div>

              <div class="form-group">
                  <label>Carreira</label>
                  <select class="form-control" name="fk_carrer_subject" id="carrerCombo">
                      <option value="">Carregando Carreira</option>
                  </select>
                 <!-- Combo com carreiras existentes -->
              </div>
              <div class="form-group">
                <label>Nome</label>
                <input type="text" name="subject_name" class="form-control" value="{{$subject['subject_name']}}">
                <!-- <p class="help-block">Example block-level help text here.</p> -->
            </div>
              <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="carrer_active">
                    <option value="1" {{($subject->subject_active) ? ' selected' : ''}}>Ativo</option>
                    <option value="0" {{($subject->subject_active) ? '' : ' selected'}}>Inativo</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success btn-circle" data-toggle="tooltip" title="Salvar"><i class="fa fa-check"></i></button> 
            <button type="reset" class="btn btn-default btn-circle" data-toggle="tooltip" title="Limpar"><i class="fa fa-times"></i></button> 
        </form>
<script type="text/javascript">
    $(document).ready(function(){
    $.get('/profissao', function(dados) {
          if(dados.length > 0)
          {
              var option = "<option value=''>Selecione Profissão</option>"
              $.each(dados, function(i, obj)
              {
                if({{($subject->fk_carrer_profession)}} === obj.profession_id)  option += "<option value='"+ obj.profession_id +"' selected>" + obj.profession_nome + "</option>"
                else option += "<option value='"+ obj.profession_id +"'>" + obj.profession_nome + "</option>";              });
              });
          $("#profissaoComno").html(option).show();
       });
       $('#professaoCombo').change(function (){
        var profissao = $('#profissaoCombo').val();
        $.get('/carreira?profissao='+profissao, function(dados){
            if (dados.length > 0){
                var option = "<option value=''>Selecione Carreira</option>"; 
                $.each(dados, function(i, obj){
                    if({{($subject->fk_subject_carrer)}} === obj.carrer_id)  option += "<option value='"+ obj.carrer_id +"' selected>" + obj.carrer_nome + "</option>"
                    else option += "<option value='"+ obj.carrer_id +"'>" + obj.carrer_nome + "</option>";
                });
                 
            } else {
                $("#carrerCombo").empty();
                var option = "<option value=''>Carregando Carreira</option>";
            }
            $("#carrerCombo").html(option).show();
            }); 
        });
 });
</script>

@endsection
@include('widgets.panel', array('header'=>true, 'as'=>'table'))
@stop