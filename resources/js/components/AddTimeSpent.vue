<template>
<div class="container mt-5">
<form id="addTimesForm" class="row g-1" @submit="formSubmit" enctype="multipart/form-data">
<input type="hidden" name="_token" :value="csrf">
<h2 class="mt-5">Потраченное время</h2>
<div id="errMsgTs" v-show="errMsgVisible" class="alert alert-danger" role="alert">
</div>
  <div class="mb-3 mt-5">
  <label for="exampleFormControlInput1" class="form-label">Затраченное время*</label>
  <input type="time" v-model="form.time_spent" name="time_spent" class="form-control" placeholder="">
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Описание работ</label>
  <textarea name="desription" v-model="form.description" class="form-control" rows="3"></textarea>
</div>


  <div class="col-auto">
    <button type="submit" v-if="mode == 'create'" class="btn btn-primary mb-3">
    Добавить время
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
     time_spent:'',
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
  task_id:null,
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
               var errMsgEl =  document.getElementById('errMsgTs');
               errMsgEl.innerHTML = '';
               this.$store.state.reload   = false;
                const config = {
                    headers: {
                        'content-type': 'application/json',
                        'X-CSRF-TOKEN': this.csrf,
                    }
                }
                
                let data = new FormData();

                data.append('time_spent', this.form.time_spent);
                data.append('description', this.form.description); 
                data.append('task_id', this.$props.task_id);
                
                let appObj = this ;
                
                var url = '/time_spent';
                if(this.mode == 'edit')
                 {
                  url = '/time_spent/'+this.ts.id;
                  data.append('_method','patch');
                 }
                
                axios.post(url, data, config)
                    .then(function (result) {
          
                    
                    appObj.close();
                    
                     if(appObj.mode != 'edit')
                    { 
                    document.getElementById('addTimesForm').reset();
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