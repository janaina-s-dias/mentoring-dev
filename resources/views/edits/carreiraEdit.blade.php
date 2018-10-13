@extends('layouts.dashboardAdmin') 
@section('page_heading','')
@section('section')
@section ('table_panel_title','Editar Carreira')
@section ('table_panel_body')

<?php $carrer = Session::get('carreira') ?>

<form role="form"  method="POST" action="{{route('carrer.update', $carrer->carrer_id)}}">
            @method('PATCH')
            @csrf
              <div class="form-group">
                  <label>Profissão</label>
                  <select class="form-control" id="profissaoCombo" name="fk_carrer_profession"> 
                      <option value="">Carregando Profissões</option>
                  </select>
                 <!-- Combo com profissões existentes -->
              </div>
            <div class="form-group">
                <label>Nome</label>
                <input type="text" name="carrer_name" class="form-control" value="{{ $carrer->carrer_name}}">
                <!-- <p class="help-block">Example block-level help text here.</p> -->
            </div>

          <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="carrer_active">
                    <option value="1" {{($carrer->carrer_active) ? ' selected' : ''}}>Ativo</option>
                    <option value="0" {{($carrer->carrer_active) ? '' : ' selected'}}>Inativo</option>
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
               if({{($carrer->fk_carrer_profession)}} === obj.profession_id)  option += "<option value='"+ obj.profession_id +"' selected>" + obj.profession_nome + "</option>"
               else option += "<option value='"+ obj.profession_id +"'>" + obj.profession_nome + "</option>";
            });
            $("#profissaoCombo").html(option).show();
            }
         });
    });
</script>
@endsection
@include('widgets.panel', array('header'=>true, 'as'=>'table'))
@stop