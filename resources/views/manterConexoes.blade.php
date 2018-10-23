@extends('layouts.dashboard') 
@section('page_heading','Conexões')

@section('section')

<!-- <div> 
    <div class="input-group">
            <span class="input-group-btn">
                <left>
                    <button class="btn btn-success" type="button" data-toggle="modal" data-toggle="tooltip" title="Inserir nova carreira" data-target="#myModal2">
                            <span class="glyphicon glyphicon-plus"></span>
                    </button>
                </left>
            </span>
    </div> 
</div>        


<br/>-->
<div class="row">
	<div>
		@section ('table_panel_title','Listagem Conexões')
		@section ('table_panel_body')
		    @include('widgets.tableConexao', array('class'=>'table-condensed'))
		@endsection
		@include('widgets.panel', array('header'=>true, 'as'=>'table'))
	</div>
</div>



@include('inc.feedback')
      
            
@stop


  