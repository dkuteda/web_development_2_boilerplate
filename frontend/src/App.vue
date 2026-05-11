<script setup>
// App component with router view
</script>

<template>
  <!-- Main Container with a soft background -->
  <div class="min-h-screen bg-slate-50 text-slate-900 font-sans antialiased">
    
    <!-- Top Navigation Bar -->
    <nav class="bg-white border-b border-slate-200 px-8 py-4">
      <div class="max-w-7xl mx-auto flex justify-between items-center">
        <div class="flex items-center gap-2">
          <div class="bg-emerald-600 p-2 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
          </div>
          <span class="text-xl font-bold tracking-tight text-slate-800">FarmLogix</span>
        </div>
        
        <div class="flex items-center gap-4">
          <span class="text-sm text-slate-500">Season: Spring 2026</span>
          <div class="h-8 w-8 rounded-full bg-slate-200 border border-slate-300"></div>
        </div>
      </div>
    </nav>

    <!-- Main Content Area -->
    <main class="max-w-7xl mx-auto px-8 py-10">
      
      <!-- Page Header Section -->
      <header class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
          <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
            Inventory Management
          </h1>
          <p class="text-slate-500 mt-1">
            Real-time overview of your farm's stocks and supplies.
          </p>
        </div>

        <div class="flex gap-3">
          <button class="px-4 py-2 text-sm font-medium text-slate-600 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-all shadow-sm">
            Export CSV
          </button>
          <button class="px-4 py-2 text-sm font-medium text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 transition-all shadow-md shadow-emerald-200">
            + New Item
          </button>
        </div>
      </header>

      <!-- The Inventory Organism -->
      <!-- Note: We don't pass props here because the Organism handles its own data from data.json -->
      <InventoryTable />

    </main>

    <!-- Simple Footer -->
    <footer class="mt-auto py-8 text-center text-slate-400 text-xs">
      &copy; 2026 FarmLogix Systems. All rights reserved.
    </footer>
  </div>
  
  <router-view />
</template>
