<template>
    <div>
        <div class="wrapper">
            <Header/>
            <Sidebar/>
            <slot></slot>
            <Footer/>
        </div>
    </div>
</template>

<script>
import Header from '../components/admin/header.vue' 
import Footer from '../components/admin/footer.vue'
import Sidebar from '../components/admin/sidebar' 

export default {
    data() {
        return {
            
        }
    },

    components : {
        Header, Sidebar, Footer
    },

    mounted() {
        document.body.classList.remove('layout-top-nav','register-page')
        document.body.classList.add('sidebar-mini', 'layout-fixed', 'layout-navbar-fixed', 'layout-footer-fixed')
    }
}
</script>
