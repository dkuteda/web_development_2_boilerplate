<script setup>
import { ref } from 'vue';
import EmployeeCard from '../Organisms/EmployeeCard.vue';

const employees = ref([
    { name: 'David Kutej', position: 'Software Engineer', imageUrl: new URL('@/assets/images/PicOfMeDavid.jpg', import.meta.url).href, alt: 'David Kutej', urlNavigationLink: 'https://github.com/dkuteda' },
    { name: 'Jane Doe', position: 'Product Manager', imageUrl: new URL('@/assets/images/PicOfMeDavid.jpg', import.meta.url).href, alt: 'Jane Doe', urlNavigationLink: 'https://github.com/dkuteda' },
    { name: 'John Smith', position: 'UX Designer', imageUrl: new URL('@/assets/images/PicOfMeDavid.jpg', import.meta.url).href, alt: 'John Smith', urlNavigationLink: 'https://github.com/dkuteda' },
    { name: 'Emily Davis', position: 'Data Scientist', imageUrl: new URL('@/assets/images/PicOfMeDavid.jpg', import.meta.url).href, alt: 'Emily Davis', urlNavigationLink: 'https://github.com/dkuteda' }
])
</script>

<template>
    <div class="grid grid-cols-1 md:grid-cols-2 min-content gap-4">
        <EmployeeCard
            v-for="employee in employees"
            :key="employee.name"
            :name="employee.name"
            :position="employee.position"
            :imageUrl="employee.imageUrl"
            :alt="employee.alt"
            :navigationLink="employee.urlNavigationLink"
        />
    </div>
</template>

