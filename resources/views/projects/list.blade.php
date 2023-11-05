@push('styles')

  @vite('resources/sass/project/list.scss')

@endpush
@push('scripts')

  @vite('resources/js/project/list.js')

@endpush

<div id="projectList">

<project-list ref="project_list"></project-list>
 <button сlass="show-modal-button" @click="showModal">Показать модальное окно</button>
 
        <vue-sidepanel 
            v-model="isOpened"
    		lock-scroll
    		side="top"
    		height="600px"
         >

          <add-project mode="create"></add-project>
        </vue-sidepanel>
        
</div>

