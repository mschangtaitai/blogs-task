import { createRouter, createWebHistory } from 'vue-router'


const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            component: () => import('../Layout.vue'),
            children: [
                {
                    path: '/login',
                    component: () => import('../views/LoginView.vue')
                },
                {
                    path: '/feed',
                    component: () => import('../views/FeedView.vue')
                },
                {
                    path: '/create',
                    component: () => import('../views/CreateBlogView.vue')
                },
                {
                    path: '/blog/:id',
                    component: () => import('../views/BlogView.vue')
                },
                {
                    path: '/userdetail/:user',
                    component: () => import('../views/UserView.vue')
                },
            ]
        }
    ]
})

export default router