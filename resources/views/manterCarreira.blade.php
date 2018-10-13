@extends('layouts.dashboardAdmin') 
@section('page_heading','')

@section('section')

<div>

<h3>Carreira</h3>   
    <form class="input-group custom-search-form">
            <!-- <input type="text" class="form-control" placeholder="Insira uma profissão para pesquisa"> -->
                <span class="input-group-btn">
                    <!-- <button class="btn btn-default" type="submit" data-toggle="tooltip" title="Pesquisar">
                        <i class="fa fa-search"></i>
                    </button> -->
            
                    <button class="btn btn-success" type="button" data-toggle="modal" data-toggle="tooltip" title="Inserir nova carreira" data-target="#myModal2">
                            <span class="glyphicon glyphicon-plus"></span>
                    </button>
                        <!-- <button class="btn btn-success" type="button" data-toggle="modal" data-toggle="tooltip" title="Novo" data-target="#myModal2">
                            <span class="glyphicon glyphicon-plus"></span>
                    </button>    -->
                </span>
    </form> 
</div>       


<br/><br/>


<div class="row">
	<div>
		@section ('table_panel_title','Carreira')
		@section ('table_panel_body')
		    @include('widgets.tableCarreira', array('class'=>'table-condensed'))
		@endsection
		@include('widgets.panel', array('header'=>true, 'as'=>'table'))
	</div>
</div>



@include('inc.feedback')
@include('modals.carreira')
      
            
@stop


  