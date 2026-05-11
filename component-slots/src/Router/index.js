import { createRouter, createWebHistory } from 'vue-router'

import Home from '../components/Pages/Home.vue'

const routes = [
        { path: '/', name: 'home', component: Home },
        //{ path: '/brazil', name: 'brazil', component: () => import('@/components/Pages/Brazil.vue') },
        //{ path: '/hawaii', name: 'hawaii', component: () => import('@/components/Pages/Hawaii.vue') },
        //{ path: '/jamaica', name: 'jamaica', component: () => import('@/components/Pages/Jamaica.vue') },
        //{ path: '/panama', name: 'panama', component: () => import('@/components/Pages/Panama.vue') },
        { path: '/destination/:id/:slug', name: "destination.show", component: () => import('@/components/Pages/DestinationShow.vue') }
    ]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router