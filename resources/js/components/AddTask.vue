<template>
<div class="container mt-5">
<form id="addTaskForm" class="row g-1" @submit="formSubmit" enctype="multipart/form-data">
<input type="hidden" name="_token" :value="csrf">
<h2 class="mt-5">Данные задачи</h2>
<div id="errMsgTsk" v-show="errMsgVisible" class="alert alert-danger" role="alert">
</div>
  <div class="mb-3 mt-5">
  <label for="exampleFormControlInput1" class="form-label">Название задачи*</label>
  <input type="text" v-model="form.title" name="title" class="form-control" placeholder="Введите название задачи">
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Описание задачи</label>
  <textarea name="desription" v-model="form.description" class="form-control" rows="3"></textarea>
</div>


  <div class="col-auto">
    <button type="submit" v-if="mode == 'create'" class="btn btn-primary mb-3">
    Добавить задачу
    </button>
    <button type="submit" v-else class="btn btn-primary mb-3">
    Сохранить
    </button>
  </div>
  </form>
  </div>
  
</template>

<script>
import axios from "axios";

export default {
  name: "AddTask",
   emits: ["modified"], 
  data() {
    return {
     form:{
     title:'',
     description:''
     },
      file: '',
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),  
      errMsgVisible:false,
    };
  },
  props:{
  mode:'',
  taskData:{},
  project_id:null,
  },
  created() {
	},
  mounted(){
	 if(this.mode == 'edit'){
		 this.loadData();
		 }
	 },
	 
 activated(){

	 },
	 
	watch: {
		mode(val){
		if(val == 'create'){
		this.form.title = '';
        this.form.description = '';
		document.getElementById('addTaskForm').reset();
		}
		
		if(val == 'edit'){
		this.loadData();
		}
		
		},
	},	
	

  methods: {
   onChange(e) {
                this.file = e.target.files[0];
            },
  loadData(){
   this.form.title = this.taskData.title;
   this.form.description = this.taskData.description;
  
  },    
  getImgUrl() {
			  return'/storage/'+ this.projectData.image.image_path ;
			},
			
     close(){
            for(var i=0; i<document.getElementsByClassName('vsp-close__x').length; ++i)
              document.getElementsByClassName('vsp-close__x')[i].click();
            },        			      
  formSubmit(e) {
                e.preventDefault();
                 this.errMsgVisible = false;
               var errMsgEl =  document.getElementById('errMsgTsk');
               errMsgEl.innerHTML = '';
               this.$store.state.reload   = false;
                const config = {
                    headers: {
                        'content-type': 'application/json',
                        'X-CSRF-TOKEN': this.csrf,
                    }
                }
                
                let data = new FormData();

                data.append('title', this.form.title);
                data.append('description', this.form.description); 
                data.append('project_id', this.$props.project_id);
                
                let appObj = this ;
                
                var url = '/task';
                if(this.mode == 'edit')
                 {
                  url = '/task/'+this.taskData.id;
                  data.append('_method','patch');
                 }
                
                axios.post(url, data, config)
                    .then(function (result) {
          
                    
                    appObj.close();
                    
                     if(appObj.mode != 'edit')
                    { 
                    document.getElementById('addTaskForm').reset();
                     }  
                     
                     appObj.$emit('modified');   

                     
                    })
                    .catch(function (error) {
                    var err = error.response.data.errors
                    appObj.errMsgVisible = true;
                    for(var prop in err){
                    if (err.hasOwnProperty(prop)) {
						    console.log(err[prop]);
						    var ap = document.createElement('div');
						    ap.innerHTML = err[prop]+'<br>';
						    errMsgEl.appendChild(ap);
						  }
                    }

                    });
            },
                
            
            
  },
};
</script>
<style>
#errMsg{

}
</style>