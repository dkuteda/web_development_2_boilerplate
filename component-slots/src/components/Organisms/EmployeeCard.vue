<script setup>
import { ref } from 'vue';
import FancyButton from '../Atoms/FancyButton.vue';

const props = defineProps({
    name: {type: String, default: 'Default Name'},
    githubUsername: {type: String, default: 'defaultusername'},
    position: {type: String, default: 'Default Position'},
    imageUrl: {type: String, default: '@/assets/images/PicOfMeDavid.jpg'},
    alt: {type: String, default: 'Employee Image'}
})

const apiData = ref();

fetch(`https://api.github.com/users/${props.githubUsername}`).then(async (response) => {
    const data = await response.json();
    apiData.value = data;
})

</script>

<template>
    <pre>{{ apiData }}</pre>
    <div class="card card-side bg-base-100 shadow-sm">
        <figure>
            <img
                :src="imageUrl"
                :alt="alt"
            />
        </figure>
        <div class="card-body">
            <h2 class="card-title">{{ name }}</h2>
            <p>{{ position }}</p>
            <div class="card-actions justify-end">
                <FancyButton :href="apiData?.html_url">
                    <template #icon="{ hover }" >
                        {{ hover ? '😍' : '🎯' }}
                    </template>
                    Visit
                </FancyButton>
            </div>
        </div>
    </div>
</template>

