<template>

<div class="container">
<div class="row">
<template v-if="isLoaded">

  <div class="">
    <div class="h-100">
    <h2 class="card-title">{{project.title}}</h2>
    <nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand"></a>
    <form class="d-flex border border-black  p-2 rounded-pill" b-1 role="edit">
     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil"   @click="showModal('edit')" viewBox="0 0 16 16">
	  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
	</svg>
	
	  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3"  @click="showModal('deleteProject')" viewBox="0 0 16 16">
	    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
	  </svg>
	

    </form>
  </div>
</nav>

      <template v-if="project.image_id != null" >
      <img  v-bind:src="getImgUrl()" title=''>
      </template>
      <div class="">
        
        <p class="card-text">{{project.description}}</p>
      </div>
    </div>
  </div>

 </template>
 </div>
 </div>
 <hr class="mt-5">

<template v-if="isLoaded">
 <TaskList :tasks="tasks_" :project_id="project.id" />
</template>

          <template v-if="isLoaded">
		           <vue-sidepanel 
		            v-model="isOpenedEdit"
		    		lock-scroll
		    		side="top"
		    		height="600px"
		         >
		         <AddProject mode="edit" @modified="loadData" :projectData="this.project" />
		         </vue-sidepanel>
		         
		           
		        <vue-sidepanel 
		            v-model="isOpenedDelProject"
		    		lock-scroll
		    		side="top"
		    		height="200px"
		         >
		          <h3 class="h3 alert mt-5">Вы действительно хотите удалить проект </h3>
		          <div class="col-4 m-auto">
		          <button class="btn btn-danger m-1" @click="deleteProject()"> да </button><button @click="closeModal()" class="btn btn-secondary m-1">отмена</button> 
		          </div>
		         </vue-sidepanel>
		        
         </template>
         

</template>

<script>
import TaskList from "../components/TaskList.vue";
import AddProject from "../components/AddProject.vue";

export default {
  name: "Project",
  components:{
       TaskList,
       AddProject
        },
  created() {},
  mounted() {
  this.loadData();
  },
  data() {
    return {
    isOpenedEdit:false,
    isOpenedDelProject:false,
    isLoaded:false,
    
    project:{},
    tasks_: {
        type: Object,
        default: () => ({}),
    },
    editableTask:{},
    
    };
  },
  props: {
    project_id: null,
  },
  methods: {
            showModal: function (varModal) {
             switch(varModal){
             case 'edit':
             this.isOpenedEdit = true;
             break;
             case 'editTask':
             this.isOpenedEditTask = true;
             break;
             case 'deleteProject':
             this.isOpenedDelProject = true;
             break;
             
             }
            },
       
            getImgUrl() {
			  return'/storage/'+ this.project.image.image_path ;
			},
			async loadData(){
	                await axios.get(`/vue_project/${this.project_id}`).then(({data})=>{
	                    this.tasks_ = data.tasks;
	                    this.project = data;
	                    //console.warn = () => {}
	                    this.isLoaded = true;
	                    
	                }).catch(({ response })=>{
	                    console.error(response)
	                })
                },
            deleteProject(){          
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                        'X-CSRF-TOKEN': this.csrf,
                    }
                }
                
                let data = new FormData();                
                let appObj = this ;
                
                var url = '/project';
                  url = '/project/'+this.project_id;
                  data.append('_method','delete');

                axios.post(url, data, config)
                    .then(function (result) {
                    
                    window.location.replace('/project');

                    })
                    .catch(function (err) {
                    console.log(err);

                    });
            },

            closeModal(){
              for(var i=0; i<document.getElementsByClassName('vsp-close__x').length; ++i)
              document.getElementsByClassName('vsp-close__x')[i].click();
            },
            
                   
  },
  watch: {
   },
  computed: {
  },
};
</script>

<style>
 svg {
    margin: 3px;
    }
    
 svg:hover{
 color:grey;
 }   

table svg {
    margin: 2px;
    }

.create-icon{
margin-left:10px;
}
 
    
</style>
