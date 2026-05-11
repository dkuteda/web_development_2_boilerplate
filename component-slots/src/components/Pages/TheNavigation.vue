<template>
    <div id="nav">
        <RouterLink id="logo" to="/">Travel App</RouterLink>
        <RouterLink 
            v-for="destination in destinations" 
            :key="destination.id" 
            :to="{name: 'destination.show', params: {id: destination.id, slug: destination.slug}}">
            {{ destination.name }}
        </RouterLink>
    </div>
</template>

<script>
import sourceData from '../../data.json';
export default {
    data(){
        return{
            destinations:sourceData.destinations
        }
    }   
}

/*
    <div id="nav">
        <RouterLink to="/">Home</RouterLink>
        <RouterLink to="/brazil">Brazil</RouterLink>
        <RouterLink to="/hawaii">Hawaii</RouterLink>
        <RouterLink to="/jamaica">Jamaica</RouterLink>
        <RouterLink to="/panama">Panama</RouterLink>
    </div>
*/
</script>
