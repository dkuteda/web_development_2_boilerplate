<script setup>
import { ref } from 'vue';
import FancyButton from '../Atoms/FancyButton.vue';

const props = defineProps({
    githubUsername: {type: String, default: 'defaultusername'},
    alt: {type: String, default: 'Employee Image'},
    isStaff: { type: Boolean, default: false }
})

const employeeData = ref();

fetch(`https://api.github.com/users/${props.githubUsername}`).then(async (response) => {
    const data = await response.json();
    employeeData.value = data;
})

const emit = defineEmits(['hire', 'fire'])

</script>

<template>
    <div v-if="employeeData" class="card card-side bg-base-100 shadow-sm">
        <figure>
            <img
                :src="employeeData?.avatar_url"
                :alt="alt"
            />
        </figure>
        <div class="card-body">
            <h2 class="card-title">{{ employeeData.name }}</h2>
            <p>{{ employeeData.company }}</p>
            <div class="card-actions justify-end">
                
                <FancyButton :href="employeeData?.html_url">
                    <template #icon="{ hover }" >
                        {{ hover ? '😍' : '🎯' }}
                    </template>
                    Visit
                </FancyButton>

                <FancyButton v-if="!isStaff" @click="emit('hire', employeeData.name)">
                    <template #icon="{ hover }">{{ hover ? '🙌' : '🤝' }}</template>
                    Hire
                </FancyButton>

                <FancyButton v-else @click="emit('fire', employeeData.name)">
                    <template #icon="{ hover }">{{ hover ? '❌' : '🚫' }}</template>
                    Fire
                </FancyButton>
            </div>
        </div>
    </div>
</template>

