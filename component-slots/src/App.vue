<script setup>
import { ref } from 'vue'
import EmployeesCardGrid from './components/Templates/EmployeesCardGrid.vue';
import AppAlerts from './components/Molecules/AppAlerts.vue';
import TheNavigation from './components/Pages/TheNavigation.vue';



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

  <TheNavigation />
  
  <div class="container">
    <router-view></router-view>
  </div>
  
</template>