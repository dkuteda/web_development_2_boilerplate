<script setup>
  import CoffeePlan from '../Molecules/CoffeePlan.vue'
  import { ref, onMounted, onUnmounted } from 'vue';

  const plans = ref([
    { name: 'The Single', price: 12.99 },
    { name: 'The Curious', price: 14.99 },
    { name: 'The Addict', price: 16.99 },
    { name: 'The Hacker', price: 18.99 }
  ]);

    const selectedCoffeePlan = ref()
  
    function handleSelectCoffeePlan(name, price) {
        selectedCoffeePlan.value = { name, price }
        // :selected="plan === selectedCoffeePlan" 
        // Instead of comparing the whole object, compare a unique property like the name.
        // :selected="plan.name === selectedCoffeePlan?.name"
    }

    const counter = ref(0)
    const interval = setInterval(() => {
        counter.value++
        console.log("Hello")
    }, 1000)

    onUnmounted(() => {
        clearInterval(interval)
        console.log('Bye bye plan picker');
    })  

</script>


<template>
    <div ref="plansWrapper" class="plans">
        {{ counter }}
        <CoffeePlan 
            v-for="plan in plans" 
            :key="plan.name" 
            :name="plan.name" 
            :price="plan.price"
            :selected="plan.name === selectedCoffeePlan?.name"  
            @selected="handleSelectCoffeePlan"
        ></CoffeePlan>
    </div>
</template>