@extends('layouts.dashboardAdmin') 
@section('page_heading','Mentores')

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


  