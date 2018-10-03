@extends('layouts.dashboard') 
@section('page_heading','Area Administrativa')
@section('section')


<div>
    <label>Segmento</label>
        <input class="form-control">
        <a class="navbar-brand" href="#" data-toggle="modal" data-target="#myModal"> <button type="button" class="btn btn-default">Adicionar</button></a>
</div>

@include('modals.segmento')
           

      
            
@stop


  