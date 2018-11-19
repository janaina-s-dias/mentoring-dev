@extends('layouts.dashboardAdmin') 

@section('titlePage')
        
        <title>Assuntos por Usuários</title>

@stop 

@section('stylesPage')
        
        

@stop 

@section('scriptsPage')
     
        
    
@stop

@section('page_heading','Assuntos por Usuários')

@section('section')

<div class="row">
	<div>
		@section ('table_panel_title','Listagem Assuntos por Usuários')
		@section ('table_panel_body')
		    @include('widgets.tableUserSubject', array('class'=>'table-condensed'))
		@endsection
		@include('widgets.panel', array('header'=>true, 'as'=>'table'))
	</div>
</div>



@include('inc.feedback')

           

@stop


  