@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">


<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Проект</th>
      <th scope="col">Кол-во задач</th>
      <th scope="col">Затрачено времени</th>
    </tr>
  </thead>
<tbody>
  @foreach ($noteList as $note)
  <tr>
   <td>{{$note['project_id']}}</td>
   <td><a href="{{ route('project.show',$note['project_id']) }}">{{$note['project_title']}}</a></td>
   <td>{{$note['count_task']}}</td>
   <td>{{$note['time_spent']}}</td>
  
  </tr>
  @endforeach
  </tbody>
 </table> 

</div>
</div>
@endsection