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



@include('modals.profissao')


@stop


