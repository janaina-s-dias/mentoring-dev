@extends('layouts.dashboardAdmin') 
@section('page_heading','')

@section('section')

<h3>Usuario</h3>   
<br/><br/>
<div class="row">
	<div>
		@section ('table_panel_title','Usuario')
		@section ('table_panel_body')
		    @include('widgets.tableUsuario', array('class'=>'table-condensed'))
		@endsection
		@include('widgets.panel', array('header'=>true, 'as'=>'table'))
	</div>
</div>



@include('inc.feedback')
@include('modals.usuarioSubject')
           

      
            
@stop


  