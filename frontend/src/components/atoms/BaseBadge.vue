<template>
  <span :class="[ 
    'px-2 py-1 rounded-full text-xs font-semibold uppercase tracking-wider',
    colorClasses 
  ]">
    <slot />
  </span>
</template>

<script setup>
import { computed } from 'vue';
const props = defineProps(['status']);

const colorClasses = computed(() => {
  const mapping = {
    active: 'bg-green-100 text-green-700',
    low_stock: 'bg-yellow-100 text-yellow-700',
    inactive: 'bg-gray-100 text-gray-700',
    soil: 'bg-amber-100 text-amber-800',
    planting: 'bg-emerald-100 text-emerald-800',
    pest_control: 'bg-red-100 text-red-800'
  };
  return mapping[props.status] || 'bg-blue-100 text-blue-700';
});
</script>