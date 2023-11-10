@extends('layouts.app')

@section('content')

    @guest
    
     	Зарегистрируйтесь чтобы пользоваться сервисом.
    
    @else
    
     	@include('projects.list');
     
    @endguest

@endsection