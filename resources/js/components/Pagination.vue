<template>
<nav aria-label="">
  <ul v-if="showPagination" class="pagination p-style mt-5">
    <li class="page-item" :class="{'disabled': !prevPageVisible}">
      <a class="page-link" @click="$emit('clicked', (parseInt(pagesData.current_page)-1) )"  href="#">&laquo;</a>
    </li>
    
    <li class="page-item" v-for="(page, key) in pages"  
    :class="{'active': page.active}"  
    v-show="((key != 0) && (key!= this.pages.length-1))" 
    >
    <a class="page-link" href="#" @click="$emit('clicked', page.label)" >{{ page.label }}</a>
    </li>
    <li class="page-item" :class="{'disabled': !nextPageVisible}">
      <a class="page-link" @click="$emit('clicked', (parseInt(pagesData.current_page)+1) )" href="#">&raquo;</a>
    </li>
  </ul>
</nav>
</template>

<script>
import axios from "axios";

export default {
  name: "Pagination",
  emits: ["clicked"],
  data() {
    return { 
    };
  },
 props: {
    pagesData: Object,
  },
  created() {
},

mounted(){
},
  methods: {
  
  },
  computed : { 
	  showPagination(){
		  if(this.pagesData.links.length > 1){
		  return true; 
		  }
		  return false;
	  },
	  
	  prevPageVisible(){
		  if(this.pagesData.current_page == 1){
		  return false;
		  }
		  return true;
	  },
	  nextPageVisible(){
		  if(this.pagesData.current_page == this.pagesData.last_page){
		  return false;
		  }
		  return true;
	  },
	  currentPage(page){
		  
		  if (this.pagesData.current_page == page)
		  {
		  return true;
		  } 
	  },
	  pages(){
	  return this.pagesData.links;
	  }                      
            
  },
};
</script>
<style>
.p-style{
width:40%;
margin:auto;
}
</style>
