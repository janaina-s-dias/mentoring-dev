@extends('layouts.dashboard')

@section('titlePage')

    <title>Solicitações</title>

@stop

@section('stylesPage')


@stop

@section('scriptsPage')


@stop



@section('section')

<div class="row">
	<div>
		@section ('table_panel_title','Listagem Solicitações')
		@section ('table_panel_body')
		    @include('widgets.tableSolicitacao', array('class'=>'table-condensed'))
		@endsection
		@include('widgets.panel', array('header'=>true, 'as'=>'table'))
	</div>
</div>



@include('inc.feedback')


@stop


