<template>
  <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow flex flex-col">
    
    <RouterLink 
      :to="`/stock/${stock.name}`"
      class="p-4 border-b border-gray-100 hover:bg-gray-50 transition-colors block"
    >
      <div class="flex justify-between items-center">
        <StockInfo :stock="stock" />
        <StockPrice :stock="stock" />
      </div>
    </RouterLink>

    <div class="p-4 bg-gray-50 flex gap-2">
      <button
        @click.stop="emit('buy', stock.name)"
        class="flex-1 bg-blue-600 text-white px-3 py-2 rounded-md hover:bg-blue-700 transition-colors font-medium text-sm"
      >
        Buy
      </button>
    </div>
  </div>
</template>
  
<script setup>
import { RouterLink } from 'vue-router'
import StockInfo from '../../molecules/StockInfo/StockInfo.vue'
import StockPrice from '../../molecules/StockPrice/StockPrice.vue'

const props = defineProps({
  stock: {
    type: Object,
    required: true,
    validator: (value) => {
      return value.name && typeof value.price === 'number' && typeof value.previousPrice === 'number'
    }
  }
})
const emit = defineEmits(['buy'])

</script>
