<template>
  <h4 class="h4 mt-5 text-center">Задачи проекта 
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" @click="showModal('addTask')" class="bi bi-plus-circle create-icon" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
</svg></h4>
  
 <div class="container mt-5">
<div class="row">

 <template v-for="task in tasks_" :key="task.id">
 
<nav class="navbar bg-body-tertiary mt-5">
  <div class="container-fluid">
    <a class="navbar-brand"><b>{{task.title}}</b></a>
    <form class="d-flex task-actions-icons" role="edit">
    
     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" @click="editTask(task.id, task)" viewBox="0 0 16 16">
	  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
	</svg>
	
	  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
	    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
	  </svg>
	

    </form>
  </div>
</nav>
<h5 class="h5">{{task.description}}</h5>
 <table class="table">
  <thead>
    <tr>
      <th class="col">#</th>
      <th class="col">Проведенные работы</th>
      <th class="col">Потраченное время</th>
      <th class="col task-actions-column">

      </th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="ts in task.time_spent" :key="ts.id">
      <th scope="row"></th>
      <td>{{ts.description}}</td>
      <td>{{ts.time_spent}}</td>
      <td>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" @click="editTimeSpent(ts.id, ts)" viewBox="0 0 16 16">
	  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
	</svg>
	
		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" @click="deleteTimeSpent(ts.id)"  viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
</svg>
      </td>
    </tr>
  </tbody>
</table>
<div class="text-end">
<button class="btn btn-success add-time-btn" @click="addTimeSpent(task.id)">Добавить время</button>
</div>
 </template>

  
</div>
</div>

                <vue-sidepanel 
		            v-model="isOpenedAddTask"
		    		lock-scroll
		    		side="bottom"
		    		height="600px"
		         >
		         <AddTask :mode="taskModalMode" 
		         :project_id="this.$props.project_id" 
		         @modified="load" 
		         :task_id="this.editableTaskID"
		         :taskData="this.editableTask"
		          />
		         </vue-sidepanel>
		         
		        <vue-sidepanel 
		            v-model="isOpenedAddTimeSpent"
		    		lock-scroll
		    		side="top"
		    		height="500px"
		         >
		         <AddTimeSpent 
		         mode="create" 
		         :task_id="this.editableTaskID" 
		         @modified="load" 
		          />
		         </vue-sidepanel> 
		         
</template>

<script>
import AddTask from "../components/AddTask.vue";
import AddTimeSpent from "../components/AddTimeSpent.vue";

export default {
  name: "TaskList",
  components:{ },
    props:['project_id','tasks'],
  created() {},
  mounted() {
  this.tasks_ = this.$props.tasks;
  this.project_id = this.$props.project_id;
  },
  data() {
    return {
    isOpenedAddTask:false,
    isOpenedAddTimeSpent:false,
    tasks_: {},
    editableTask:{},
    editableTaskID:null,
    project_id:null,
    taskModalMode: 'create',
    
    };
  },

  methods: {
            showModal: function (varModal) {
             switch(varModal){
             case 'addTask':
             this.taskModalMode = 'create';
             this.isOpenedAddTask = true;
             this.editableTask = {};
             break;
             case 'editTask':
             this.taskModalMode = 'edit';
             this.isOpenedAddTask = true;
             break;
             case 'deleteProject':
             this.isOpenedDelProject = true;
             break;
             case 'addTimeSpent':
             this.isOpenedAddTimeSpent = true;
             break;
             
             }
            },
            getImgUrl() {
			  return'/storage/'+ this.project.image.image_path ;
			},
			async load(){
	                await axios.get(`/vue_project/${this.project_id}`).then(({data})=>{
	                    this.tasks_ = data.tasks;
	                    this.project = data;
	                    this.isLoaded = true;
	                }).catch(({ response })=>{
	                    console.error(response)
	                })
                },
            editTask(id, task){
            this.editableTask = task;
            this.editableTaskID = id;
                     
            this.showModal('editTask');
            
            },   
            deleteTask(){          
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                        'X-CSRF-TOKEN': this.csrf,
                    }
                }
                
                let data = new FormData();                
                let appObj = this ;

                 var url = '/task/'+this.task_id;
                  data.append('_method','delete');

                axios.post(url, data, config)
                    .then(function (result) {
                    
                    window.location.replace('/project');

                    })
                    .catch(function (err) {
                    console.log(err);

                    });
            },
            addTimeSpent(taskId){
            this.editableTaskID = taskId;
            this.showModal('addTimeSpent');
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
.task-actions-column{
min-width:60px;
}

.task-actions-icons svg{
color:#267b1c;
}

.add-time-btn{
width:100px;
margin-right:10px;
}   
</style>