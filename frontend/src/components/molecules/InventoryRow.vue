<template>
  <tr class="hover:bg-slate-50 transition-colors border-b border-slate-200">
    <td class="px-6 py-4 font-medium text-slate-900">{{ item.InventoryItemName }}</td>
    <td class="px-6 py-4">
      <BaseBadge :status="item.Category">{{ item.Category.replace('_', ' ') }}</BaseBadge>
    </td>
    <td class="px-6 py-4">
      <div class="flex items-center">
        <span :class="item.StockLevel < 20 ? 'text-red-600 font-bold' : 'text-slate-600'">
          {{ item.StockLevel }}
        </span>
      </div>
    </td>
    <td class="px-6 py-4 text-slate-500 text-sm italic">{{ item.Description }}</td>
    <td class="px-6 py-4">
      <BaseBadge :status="item.Status">{{ item.Status }}</BaseBadge>
    </td>
  </tr>
</template>

<script setup>
import BaseBadge from './Atoms/BaseBadge.vue';
defineProps({
  item: {
    type: Object,
    required: true
  }
});
</script>