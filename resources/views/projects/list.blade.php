@push('styles')

  @vite('resources/sass/project/list.scss')

@endpush
@push('scripts')

  @vite('resources/js/project/list.js')

@endpush

<div id="projectList">
 <h4 class="h4 mt-5 mb-5 text-center">Ваши проекты 
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" @click="showModal" class="bi bi-plus-circle create-icon" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
</svg></h4>

<project-list ref="project_list"></project-list>
 
        <vue-sidepanel 
            v-model="isOpened"
    		lock-scroll
    		side="top"
    		height="700px"
         >

          <add-project mode="create"></add-project>
        </vue-sidepanel>
        
</div>

