import { createRouter, createWebHistory } from 'vue-router'

import Home from '../components/Pages/Home.vue'
import About from '../components/Pages/About.vue'
import Brazil from '@/components/Pages/Brazil.vue'
import Hawaii from '@/components/Pages/Hawaii.vue'
import Jamaica from '@/components/Pages/Jamaica.vue'
import Panama from '@/components/Pages/Panama.vue'

const routes = [
        { path: '/', name: 'home', component: Home },
        { path: '/about', name: 'about', component: About },
        { path: '/brazil', name: 'brazil', component: Brazil },
        { path: '/hawaii', name: 'hawaii', component: Hawaii },
        { path: '/jamaica', name: 'jamaica', component: Jamaica },
        { path: '/panama', name: 'panama', component: Panama }
    ]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router