require('./bootstrap');

import { createApp } from 'vue'
import router from './router'
import store from './store'
import Sweetalert from 'vue-sweetalert2'

import App from './app/mainapp.vue'

createApp(App).use(Sweetalert).use(router).use(store).mount('#app')
