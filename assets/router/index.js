import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '../views/HomeView.vue';
import AboutView from '../views/AboutView.vue';

const router = createRouter({
    // history: createWebHistory(import.meta.env.BASE_URL),
    history: createWebHistory('/'),
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomeView
        },
        {
            path: '/about',
            name: 'about',
            component: AboutView
        },
        {
            path: '/:pathMatch(.*)*',
            name: 'not-found',
            component: HomeView
        },
        {
            path: '/:pathMatch(.*)',
            name: 'bad-not-found',
            component: HomeView
        },
    ]
});

export default router;
