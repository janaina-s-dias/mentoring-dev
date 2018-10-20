@extends('layouts.dashboardPerfil')
@section('page_heading','Minhas Mentorias')
@section('section')
@php
    $user = Session::get('user');
@endphp
<script type="text/javascript">
    $(document).ready(function(){
       $.get("{{route('knowledge.show', $user->user_id)}}", function(data)
       {
           
       }); 
    });
</script>    
            
@stop
