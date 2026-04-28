<script setup>
import { ref } from 'vue';
import EmployeeCard from '../Organisms/EmployeeCard.vue';

const employees = ref([
    { githubUsername: 'dkuteda', alt: 'David Kutej'},
])
</script>

<template>
    <div class="grid grid-cols-1 md:grid-cols-2 min-content gap-4">
        <EmployeeCard
            v-for="employee in employees"
            :key="employee.githubUsername"

            :githubUsername="employee.githubUsername"
            :alt="employee.alt"
        />
    </div>
</template>

