<template>
    <div>
        <slot></slot>
    </div>
</template>

<script>
export default {

    mounted() {
        document.body.classList.remove('sidebar-mini', 'layout-fixed', 'layout-navbar-fixed', 'layout-footer-fixed','layout-top-nav')
        document.body.classList.add('register-page')
    },
}
</script>
