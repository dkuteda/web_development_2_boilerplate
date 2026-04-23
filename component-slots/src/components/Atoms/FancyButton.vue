<script setup>
    import { ref } from 'vue'
    const hover = ref(false)

    const props = defineProps({
        href: {type: String, default: '#'}
    })

    const navigate = () => {
    if (props.href !== '#') {
        window.open(props.href, '_blank'); // Opens link in new tab
    }
}

</script>

<template>
  <button class="btn btn-primary" 
    @mouseenter="hover = true" 
    @click="navigate"
    @mouseleave="hover = false"
  >
  
    <slot name="icon" :hover="hover">🎯</slot>
    <slot>Click Me</slot>
  </button>
</template>