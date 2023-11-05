import { createApp } from "vue";
import { createStore } from 'vuex';
import ProjectList from "../components/ProjectList.vue";
import AddProject from "../components/AddProject.vue";
import { VueSidePanel } from 'vue3-side-panel';
import 'vue3-side-panel/dist/vue3-side-panel.css';


export const store = createStore({
  state() {
    return {
      project:{},
      reload:false,
      isOpened:false,
    }
  },
  mutations: {
	reset(){
		this.state.realod = false;
		this.state.project = {};
	},
	
  }
})

const projectList = createApp({  
	data() {
    return { 
		isOpened:false,
		 }
    },
    store: store,
	methods: {
	    showModal() {
		 this.isOpened = true;
	     store.state.isOpened = true;
	    },
	     increment() {
	      store.commit('increment')
	    },
    },
    watch: {
   '$store.state.isOpened' : function() {
     this.isOpened = store.state.isOpened;
     },
   },
    computed: {
		isOpenedModal(){
			return store.state.isOpened;
		}
  }
    
    
  
  });
  

projectList.component('project-list', ProjectList);
projectList.component('vue-sidepanel',VueSidePanel);
projectList.component('add-project',AddProject);


projectList.use(store);
projectList.mount("#projectList");
