<script setup>
    import { ref } from 'vue'
    const hover = ref(false)

    const props = defineProps({
        url: {type: String, default: '#'}
    })

    const navigateToLink = () => {
      if(props.url && props.url !== '#') {
        window.open(props.url, '_blank');
      }
    }
</script>

<template>
  <button class="btn btn-primary" @mouseenter="hover = true" random="Hello" @mouseleave="hover = false" @click="navigateToLink">
    <slot name="icon" :hover="hover">🎯</slot>
    <slot>Click Me</slot>
  </button>
</template>