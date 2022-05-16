import { createRouter , createWebHistory } from 'vue-router'
import store from './store'

import website from './app/layout/website.vue'
import admin from './app/layout/admin.vue'
import authentication from './app/layout/authentication.vue'

import home from './app/website/frontpage.vue'
import hospitals from './app/website/hospitals.vue'
import registration from './app/authentication/registration.vue'
import login from './app/authentication/login.vue'

import dashboard from './app/admin/dashboard.vue'
import add_hospital from './app/admin/hospitals/add.vue'
import update_hospital from './app/admin/hospitals/update.vue'
import hospital_list from './app/admin/hospitals/list.vue'

import notfound from './app/website/not_found.vue'

const routes = [
    {
        path : '/',
        name : 'home',
        component : home,
        meta : { layout: website }
    },
    {
        path : '/hospitals',
        name : 'hospitals',
        component : hospitals,
        meta : { layout: website }
    },
    {
        path: '/registration',
        name: 'registration',
        component: registration,
        meta: {layout: authentication, isVisitor : true }
    },
    {
        path: '/login',
        name: 'login',
        component: login,
        meta: {layout: authentication, isVisitor : true }
    },
    {
        path: '/admin/dashboard',
        name: 'dashboard',
        component: dashboard,
        meta: {layout: admin, requiresAuth : true}
    },
    {
        path: '/admin/add-hospital',
        name: 'add_hospital',
        component: add_hospital,
        meta: {layout: admin, requiresAuth : true}
    },
    {
        path: '/update-hospital/:id',
        name: 'update_hospital',
        component: update_hospital,
        meta: {layout: admin, requiresAuth : true}
    },
    {
        path: '/admin/hospital-list',
        name: 'hospital_list',
        component: hospital_list,
        meta: {layout: admin, requiresAuth : true}
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'notfound',
        component: notfound,
        meta: {layout: website}
    }
]

var router = createRouter({
    history : createWebHistory(process.env.BASE_URL),
    routes
})

function loggedIn() {
    return localStorage.getItem('token')
}

router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.requiresAuth)) {
       if(!loggedIn()) {
           next({
               name : 'login'
           })
       }else{
           next()
       }
    }else if(to.matched.some(record => record.meta.isVisitor)) {
        if(loggedIn()) {
             next({
                 name : 'dashboard'
             })
        }else{
            next()
        }
     }else{
       next()
    }
})

export default router