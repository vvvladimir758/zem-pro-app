<template>

<div class="container">
<div class="row row-cols-1 row-cols-md-3 g-4">

<template v-for="project in projects_.data" :key="project.id">
  <a :href="getProjectUrl(project.id)">
  <div class="col">
    <div class="card h-100">
    
      <svg v-if="project.image_id == null" class="bd-placeholder-img card-img-top" width="100%" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false">
      <title>Placeholder</title>
      <rect width="100%" height="100%" fill="#868e96"></rect>
      <text x="40%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
      </svg>
      <img  v-else v-bind:src="getImgUrl(project.image.image_path)" title=''>
      <div class="card-body">
        <h5 class="card-title">{{project.title}}</h5>
        <p class="card-text">{{project.description}}</p>
      </div>
    </div>
  </div>
  </a>
 </template>
 

  
</div>
</div>
 
 <Pagination v-if="projects_.links.length>3" @clicked="list" :pagesData="projects_"/>
</template>

<script>
import Pagination from "../components/Pagination.vue";
export default {
  name: "ProjectList",
  components:{
  Pagination
        },
  created() {},
  mounted() {
  this.list();
  
  },
  data() {
    return {
    projects_: {
        type: Object,
        links:[1],
        default: () => ({}),
    },
    };
  },
  props: {
    projects: Object,
  },
  methods: {
            showModal: function () {
                this.$refs.modal.show = true
            },
            getImgUrl(pic) {
			  return'storage/' + pic;
			},
			getProjectUrl(id){
			 return '/project/' + id;
			},
			async list(page=1){
	                await axios.get(`/vue_projects?page=${page}`).then(({data})=>{
	                    this.projects_ = data;

	                }).catch(({ response })=>{
	                    console.error(response)
	                })
                },   
  },
  watch: {
    '$store.state.reload' : function() {
	 this.list(1);
	 this.$store.state.realod = false;
     }
   },
  computed: {

  },
};
</script>
