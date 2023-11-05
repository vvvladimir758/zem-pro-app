import { createApp } from "vue";
import { createStore } from 'vuex';
import ShowProject from "../components/ShowProject.vue";
import AddTask from "../components/AddTask.vue";
import AddTimeSpent from "../components/AddTimeSpent.vue";
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

const project = createApp({  
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
  

project.component('show-project', ShowProject);
project.component('vue-sidepanel',VueSidePanel);
project.component('AddTask',AddTask);
project.component('AddTimeSpent',AddTimeSpent);


project.use(store);
project.mount("#project");