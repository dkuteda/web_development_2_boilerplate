<script setup>
import { ref } from 'vue';
import EmployeeCard from '../Organisms/EmployeeCard.vue';

const employees = ref([
    { name: 'David Kutej', githubUsername: 'dkuteda', position: 'Software Engineer', imageUrl: new URL('@/assets/images/PicOfMeDavid.jpg', import.meta.url).href, alt: 'David Kutej'},
])
</script>

<template>
    <div class="grid grid-cols-1 md:grid-cols-2 min-content gap-4">
        <EmployeeCard
            v-for="employee in employees"
            :key="employee.githubUsername"
            :name="employee.name"
            :githubUsername="employee.githubUsername"
            :position="employee.position"
            :imageUrl="employee.imageUrl"
            :alt="employee.alt"
        />
    </div>
</template>

