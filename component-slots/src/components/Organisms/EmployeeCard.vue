<script setup>
import { ref } from 'vue';
import FancyButton from '../Atoms/FancyButton.vue';

const props = defineProps({
    name: {type: String, default: 'Default Name'},
    position: {type: String, default: 'Default Position'},
    imageUrl: {type: String, default: '@/assets/images/PicOfMeDavid.jpg'},
    alt: {type: String, default: 'Employee Image'},
    navigationLink: {type: String, default: '#'}
})

</script>

<template>
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
                <FancyButton :url="navigationLink">
                    <template #icon="{ hover }" >
                        {{ hover ? '😍' : '🎯' }}
                    </template>
                    Visit
                </FancyButton>
            </div>
        </div>
    </div>
</template>

