<script setup>
import { ref } from 'vue'
import EmployeesCardGrid from './components/Templates/EmployeesCardGrid.vue';
import AppAlerts from './components/Molecules/AppAlerts.vue';



function handleClose(){
  console.log('Alert closed');
}

/* 
  <div class="container mx-auto">
    <EmployeesCardGrid />
  </div>
*/
</script>

<template>

  <div id="nav">
    <RouterLink to="/">Home</RouterLink>
    <RouterLink to="/brazil">Brazil</RouterLink>
    <RouterLink to="/hawaii">Hawaii</RouterLink>
    <RouterLink to="/jamaica">Jamaica</RouterLink>
    <RouterLink to="/panama">Panama</RouterLink>
  </div>
  
  <div class="container">
    <router-view></router-view>
  </div>
  
</template>