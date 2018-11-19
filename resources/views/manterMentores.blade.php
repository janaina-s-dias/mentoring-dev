@extends('layouts.dashboardAdmin') 

@section('titlePage')
        
        <title>Mentores</title>

@stop 

@section('stylesPage')
        
        

@stop 

@section('scriptsPage')
     
        
    
@stop



@section('section')

<div class="row">
	<div>
		@section ('table_panel_title','Listagem Mentores')
		@section ('table_panel_body')
		    @include('widgets.tableMentorAdmin', array('class'=>'table-condensed'))
		@endsection
		@include('widgets.panel', array('header'=>true, 'as'=>'table'))
	</div>
</div>



@include('inc.feedback')

           

      
            
@stop


  