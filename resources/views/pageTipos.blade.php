@extends('layouts.dashboardAdmin') 
@section('page_heading','')

@section('section')

<div>

<h3>Profissão</h3>   
    <form class="input-group custom-search-form">
            <input type="text" class="form-control" placeholder="Insira uma profissão para pesquisa">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" data-toggle="tooltip" title="Pesquisar">
                        <i class="fa fa-search"></i>
                    </button>
                    <button class="btn btn-success" type="button" data-toggle="modal" data-toggle="tooltip" title="Novo" data-target="#myModal">
                        +
                    </button>   
                </span>
    </form> 
    <div>
</div>       


<br/><br/><br/><br/><br/>



<div class="row">
	<div class="col-sm-6">
		@section ('table_panel_title','Profissão')
		@section ('table_panel_body')
		    @include('widgets.tableProfissao', array('class'=>'table-condensed'))
		@endsection
		@include('widgets.panel', array('header'=>true, 'as'=>'table'))
	</div>
</div>





@include('modals.profissao')
           

      
            
@stop


  