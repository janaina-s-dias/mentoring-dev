@extends('layouts.dashboardAdmin') 
@section('page_heading','')
@section('section')
@section ('table_panel_title','Editar Carreira')
@section ('table_panel_body')

<?php $carrer = Session::get('carreira') ?>

<form role="form"  method="POST" action="{{route('carrer.update', $carrer->carrer_id)}}">
            @method('PATCH')
            @csrf
              <div class="form-group{{ $errors->has('fk_carrer_profession') ? ' has-error' : '' }}">
                  <label>Profissão</label>
                  <select class="form-control" id="profissaoCombo" name="fk_carrer_profession"> 
                      <option value="">Carregando Profissões</option>
                  </select>
                 <!-- Combo com profissões existentes -->
                 @if ($errors->has('fk_carrer_profession'))
                        <small class="text-danger" role="alert">
                            <strong>{{ $errors->first('user_nome') }}</strong>
                        </small>
                @endif
              </div>
            <div class="form-group{{ $errors->has('carrer_name') ? ' has-error' : '' }}">
                <label>Nome</label>
                <input type="text" name="carrer_name" class="form-control" value="{{ $carrer->carrer_name}}">
                <!-- <p class="help-block">Example block-level help text here.</p> -->
                @if ($errors->has('carrer_name'))
                        <small class="text-danger" role="alert">
                            <strong>{{ $errors->first('carrer_name') }}</strong>
                        </small>
                @endif
            </div>

                <input type="hidden"  value="{{$carrer->carrer_active}}" name="carrer_active">                    
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