@extends('layouts.dashboardAdmin') 
@section('page_heading','')

@section('section')

<div>

<h3>Usuarios e Assuntos</h3>   
</div>       


<br/><br/>


<div class="row">
	<div>
		@section ('table_panel_title','Assuntos por Usuarios')
		@section ('table_panel_body')
		    @include('widgets.tableUserSubject', array('class'=>'table-condensed'))
		@endsection
		@include('widgets.panel', array('header'=>true, 'as'=>'table'))
	</div>
</div>



@include('inc.feedback')

           

@stop


  