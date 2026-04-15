<template>
  <StockTickerTemplate>
    <StockList :stocks="stocks" :columns="2" />
  </StockTickerTemplate>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import StockTickerTemplate from '../../templates/StockTickerTemplate/StockTickerTemplate.vue'
import StockList from '../../organisms/StockList/StockList.vue'

const stocks = ref([])
let priceUpdateInterval = null

// Sample data - in a real app, this would come from an API
const loadStocks = () => {
  stocks.value = [
    { name: 'CRM', price: 245.80, previousPrice: 245.80 }, // Salesforce - 1-1-1 philanthropic model
    { name: 'UL', price: 48.25, previousPrice: 48.00 }, // Unilever - sustainability leader
    { name: 'FSLR', price: 185.40, previousPrice: 183.50 }, // First Solar - renewable energy
    { name: 'ECL', price: 198.75, previousPrice: 200.00 }, // Ecolab - water & energy solutions
    { name: 'BYND', price: 8.45, previousPrice: 8.60 }, // Beyond Meat - plant-based food
    { name: 'TILE', price: 12.30, previousPrice: 12.50 } // Interface - carbon negative flooring
  ]
}

// Update stock prices with small random variations
const updateStockPrices = () => {
  stocks.value = stocks.value.map(stock => {
    // Generate a random price change between -2% and +2%
    const changePercent = (Math.random() * 4 - 2) / 100
    const newPrice = Math.max(0.01, stock.price * (1 + changePercent))
    
    return {
      ...stock,
      previousPrice: stock.price,
      price: Math.round(newPrice * 100) / 100 // Round to 2 decimal places
    }
  })
}

onMounted(() => {
  loadStocks()
  // Update prices every second
  priceUpdateInterval = setInterval(updateStockPrices, 2000)
})

onUnmounted(() => {
  // Clean up interval when component is unmounted
  if (priceUpdateInterval) {
    clearInterval(priceUpdateInterval)
  }
})
</script>
