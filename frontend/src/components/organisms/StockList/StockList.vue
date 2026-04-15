<script setup>
import { ref, computed } from 'vue'
import StockCard from '../StockCard/StockCard.vue'
import PortfolioItem from '../../molecules/PortfolioItem/PortfolioItem.vue'


const props = defineProps({
  stocks: {
    type: Array,
    required: true,
    validator: (value) => {
      return value.every(stock => 
        stock.name && 
        typeof stock.price === 'number' && 
        typeof stock.previousPrice === 'number'
      )
    }
  },
  columns: {
    type: Number,
    default: 1,
    validator: (value) => value >= 1 && value <= 4
  }
})

const gridClasses = computed(() => {
  const columnClasses = {
    1: 'grid-cols-1',
    2: 'grid-cols-1 md:grid-cols-2',
    3: 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3',
    4: 'grid-cols-1 md:grid-cols-2 lg:grid-cols-4'
  }
  return columnClasses[props.columns] || columnClasses[1]
})

const portfolio = ref([])
const startingCash = 1000
const newCash = ref(startingCash)

const handleSell = (tickerSymbol) => {
  const existingItem = portfolio.value.find(item => item.name === tickerSymbol)
  if(!existingItem) return
  
  newCash.value += existingItem.price

  if(existingItem.quantity > 1)
  {
    existingItem.quantity -= 1

  }
  else
  {
    portfolio.value = portfolio.value.filter(item => item.name !== tickerSymbol)
  }
}

const handleBuy = (tickerSymbol) => {
  const stock = props.stocks.find(s => s.name === tickerSymbol)
  if(!stock || newCash.value < stock.price) {
    alert('Not enough cash to buy this stock!')
    return
  }

  const existingItem = portfolio.value.find(item => item.name === tickerSymbol)

  newCash.value -= stock.price
  if(existingItem)
  {
    existingItem.quantity += 1

  }
  else
  {
    portfolio.value.push({ 
      name: stock.name,
      price: stock.price,
      quantity: 1
    })
  }
}

const totalPortfolioValue = computed(() => {
  return portfolio.value.reduce((total, item) => {
    return total + (item.price * item.quantity)
  }, 0)
})
</script>


<template>
  <div class="space-y-8">
    <section>
      <div class="grid gap-4" :class="gridClasses">
        <StockCard
          v-for="stock in stocks"
          :key="stock.name"
          :stock="stock"
          @buy="handleBuy"
        />
      </div> 
    </section>

    <section class="bg-gray-100 p-6 rounded-xl border border-gray-200">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Your Portfolio</h2>
        <h3 class="text-sm text-gray-500">Cash: <span class="font-mono font-bold text-blue-600">${{ newCash.toFixed(2) }}</span></h3>
        <div class="text-lg">
          Total Value: <span class="font-mono font-bold text-green-600">${{ totalPortfolioValue.toFixed(2) }}</span>
        </div>
      </div>

      <div v-if="portfolio.length > 0" class="space-y-2">
        <PortfolioItem 
          v-for="item in portfolio" 
          :key="item.name" 
          :stock="item"
          @sell="handleSell" 
        />
      </div>
      <p v-else class="text-gray-500 italic">Your portfolio is currently empty. Buy some stocks!</p>
    </section>
  </div>

</template>