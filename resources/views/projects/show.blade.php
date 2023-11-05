@extends('layouts.app')

@push('styles')

  @vite('resources/sass/project/list.scss')

@endpush
@push('scripts')

  @vite('resources/js/project/show.js')

@endpush

@section('content')
<div id="project">

<show-project :project_id="{{$project->id}}"></show-project>
 
        
</div>
@endsection
