<template>
    <div class="home">
        <h1 class="text-4xl font-bold mb-4">All Destinations</h1>
        <div class="destinations">
            <RouterLink 
                v-for="destination in destinations" 
                :key="destination.id" 
                :to="{name: 'destination.show', params: {id: destination.id, slug: destination.slug}}">
                <h2 class="text-2xl font-semibold">{{ destination.name }}</h2>
                <img :src="getImgUrl(destination.image)" :alt="destination.name"/>
            </RouterLink>
        </div>
    </div>
</template>

<script>
import sourceData from '../../data.json';

export default {
    data() {
        return {
            destinations: sourceData.destinations
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
