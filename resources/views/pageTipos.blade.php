@extends('layouts.dashboardAdmin')

@section('titlePage')

        <title>Profissões</title>

@stop

@section('stylesPage')



@stop

@section('scriptsPage')



@stop


@section('section')
<div>
    <div class="input-group">
        <span class="input-group-btn">
            <left>
                <button class="btn btn-success" type="button" data-toggle="modal" data-toggle="tooltip" title="Inserir nova profissão" data-target="#myModal">
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </left>
        </span>
    </div>
</div>


<br/>

<div class="row">
	<div>
		@section ('table_panel_title','Listagem Profissões')
		@section ('table_panel_body')
		    @include('widgets.tableProfissao', array('class'=>'table-condensed'))
		@endsection
		@include('widgets.panel', array('header'=>true, 'as'=>'table'))
	</div>
</div>

@include('inc.feedback')

<br/><br/><br/><br/>

<div>
    <form role="form" method="POST" action="{{route('profession.store')}}">
        @csrf
        <div class="form-group{{ $errors->has('profession_name') ? ' has-error' : '' }}">
        <label>Nome</label>
         <input class="form-control" name="profession_name">
        @if ($errors->has('profession_name'))
            <small class="text-danger" role="alert">
                <strong>{{ $errors->first('profession_name') }}</strong>
            </small>
        @endif
         </div>
          <input type="hidden" value="1" name="profession_active">
          <button type="submit" class="btn btn-success btn-circle" data-toggle="tooltip" title="Salvar"><i class="fa fa-check"></i></button>
           <button type="reset" class="btn btn-default btn-circle" data-toggle="tooltip" title="Limpar"><i class="fa fa-times"></i></button>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function(){
       if({{$errors->has('profession_name')}})
       {
           $('#myModal').modal('show');
       }
    });
</script>



@stop


