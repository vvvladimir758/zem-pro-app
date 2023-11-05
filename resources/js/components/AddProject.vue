<template>
<div class="container mt-5">
<form id="addProjectForm" class="row g-1" @submit="formSubmit" enctype="multipart/form-data">
<input type="hidden" name="_token" :value="csrf">
<h2 class="mt-5">Данные проекта</h2>
<div id="errMsg" v-show="errMsgVisible" class="alert alert-danger" role="alert">
</div>
  <div class="mb-3 mt-5">
  <label for="exampleFormControlInput1" class="form-label">Название проекта*</label>
  <input type="text" v-model="form.title" name="title" class="form-control" placeholder="Введите название проекта">
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Описание проекта</label>
  <textarea name="desription" v-model="form.description" class="form-control" rows="3"></textarea>
</div>
<div class="mb-3">
  <label for="formFile" class="form-label">Изображение</label>
  <div v-if="this.mode=='edit' && this.projectData.image_id != null">
  <br>
  <p>
  (изображение которое стоит сейчас , чтобы обновить просто загрузите другое)
  </p>
  <img :src="getImgUrl()" title="" />
  <br><br>
  </div>
  
  <input class="form-control" v-on:change="onChange" type="file" name="image">
</div>

  <div class="col-auto">
    <button type="submit" v-if="mode == 'create'" class="btn btn-primary mb-3">
    Добавить проект
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
  name: "addProject",
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
  mode:'create',
  projectData:{},
  },
  created() {
	},
	mounted(){
	 if(this.mode == 'edit'){
	 
	 this.loadData();
	 }
	
	},

  methods: {
   onChange(e) {
                this.file = e.target.files[0];
            },
  loadData(){
   this.form.title = this.projectData.title;
   this.form.description = this.projectData.description;
  
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
               var errMsgEl =  document.getElementById('errMsg');
               errMsgEl.innerHTML = '';
               
               this.$store.state.reload   = false;
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                        'X-CSRF-TOKEN': this.csrf,
                    }
                }
                
                let data = new FormData();
                
                if(this.file){
                 data.append('image', this.file);
                }
                
                data.append('title', this.form.title);
                data.append('description', this.form.description); 
                
                let appObj = this ;
                
                var url = '/project';
                if(this.mode == 'edit')
                 {
                  url = '/project/'+this.projectData.id;
                  data.append('_method','patch');
                 }
                
                axios.post(url, data, config)
                    .then(function (result) {
                   
                    appObj.$store.state.project  = result.data;
                    appObj.$store.state.reload   = true;
                    appObj.$store.state.isOpened = false;  
                    
                    appObj.close();
                    
                     if(appObj.mode != 'edit')
                    { 
                    document.getElementById('addProjectForm').reset();
                     }  
                     
                        if(appObj.mode == 'edit')
                     { 
                     appObj.$emit('modified');   
                     }
                     
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
