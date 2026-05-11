<template>
    <section class="destination">
        <h1>{{ destination.name }}</h1>
        <div class="destination-details">
            <img :src="getImgUrl(destination.image)" :alt="destination.name" class="destination-image">
            <p >{{ destination.description }}</p>
        </div>
    </section>
</template>

<style>  
h1 {
    color: #2c3e50;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
} 
</style>

<script>
import sourceData from '@/data.json';

export default {
    computed: {
        destinationId() {
            return parseInt(this.$route.params.id);
        },

        destination() {
            return sourceData.destinations.find(destination => destination.id === this.destinationId);
        }
    },
    methods: {
        getImgUrl(imageName) {
            // This tells Vite exactly where to look and handles the build-time hashing
            return new URL(`../../assets/images/${imageName}`, import.meta.url).href;
        }
    }
}
</script>