<template>
    <div>
        <div class="wrapper">
            <Header/>
            <slot></slot>
            <Footer/>
        </div>
    </div>
</template>

<script>
import Header from '../components/website/header.vue'
import Footer from '../components/website/footer.vue'

export default {
    components : {
        Header, Footer
    },

    mounted() {
        document.body.classList.remove('sidebar-mini', 'layout-fixed', 'layout-navbar-fixed', 'layout-footer-fixed','register-page')
        document.body.classList.add('layout-top-nav')
    }


}
</script>

<style scoped>
</style>
