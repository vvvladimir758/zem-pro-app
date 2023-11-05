@extends('layouts.app')

@section('content')

    @guest
    
     	Зарегистрируйтесь чтобы пользоваться сервисом.
    
    @else
    
     	@include('projects.list',['projects'=>$projects]);
     
    @endguest

@endsection