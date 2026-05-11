<template>
  <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse">
        <thead class="bg-slate-50 border-b border-slate-200 text-slate-600 text-sm uppercase tracking-tight">
          <tr>
            <th class="px-6 py-4 font-semibold">Item Name</th>
            <th class="px-6 py-4 font-semibold">Category</th>
            <th class="px-6 py-4 font-semibold">Stock</th>
            <th class="px-6 py-4 font-semibold">Description</th>
            <th class="px-6 py-4 font-semibold">Status</th>
          </tr>
        </thead>
        <tbody>
          <InventoryRow 
                v-for="item in inventoryData" 
                :key="item.InventoryItemId" 
                :item="item" 
            />
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import InventoryRow from '../molecules/InventoryRow.vue';
import rawData from '../../data.json';

const inventoryData = ref([]);

defineProps({
  items: { type: Array, required: true }
});

onMounted(() => {
  // Simulate a "getAll()" fetch call
  inventoryData.value = rawData;
});
</script>