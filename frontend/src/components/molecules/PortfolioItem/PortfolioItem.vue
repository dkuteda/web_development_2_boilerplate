<template>
  <div class="flex justify-between items-center p-3 bg-gray-50 rounded-md border border-gray-100">
    <div>
      <span class="font-bold text-gray-800">{{ stock.name }}</span>
      <span class="ml-2 text-sm text-gray-500">Qty: {{ stock.quantity }}</span>
    </div>
    <div class="text-right">
      <div class="font-semibold">${{ (stock.price * stock.quantity).toFixed(2) }}</div>
      <div class="text-xs text-gray-400">@ ${{ stock.price.toFixed(2) }} ea</div>
    </div>
    <div class="p-4 bg-gray-50 flex gap-2">
      <button
        @click.stop="emit('sell', stock.name)"
        class="flex-1 bg-red-600 text-white px-3 py-2 rounded-md hover:bg-red-700 transition-colors font-medium text-sm"
      >
        Sell
      </button>
    </div>
  </div>
</template>

<script setup>
defineProps({
  stock: {
    type: Object,
    required: true
  }
})
const emit = defineEmits(['sell'])
</script>