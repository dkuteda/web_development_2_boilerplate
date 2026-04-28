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
  <div class="container mx-auto">
    <AppAlerts type="info" @closed="handleClose">New software update available.</AppAlerts>
    <AppAlerts type="success" @closed="handleClose">Operation completed successfully.</AppAlerts>
    <AppAlerts type="warning" @closed="handleClose">Please check your input.</AppAlerts>
    <AppAlerts type="error" @closed="handleClose">An error occurred.</AppAlerts>

  </div>
</template>