<template>
    <div>
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
            <router-link to="/" class="navbar-brand">
                <!-- <img src="/website/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
                <span class="brand-text font-weight-light">Jororiseba</span>
            </router-link>

            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link to="/" class="nav-link">Home</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/hospitals" class="nav-link">Hospitals</router-link>
                    </li>
                </ul>
            </div>

            <!-- Right navbar links -->
            <!-- If logged in  -->
            <ul v-if="currentUser.name" class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <!-- User Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <router-link to="/admin/dashboard" class="dropdown-item text-right">
                            Dashboard
                        </router-link>
                        <div class="dropdown-divider"></div>
                        <button @click="logout()" type="button" class="dropdown-item text-right">
                            Logout
                        </button>
                    </div>
                </li>
                <li class="nav-item">
                    <a v-if="currentUser.name" class="nav-link" href="#">{{ currentUser.name }}</a>
                </li>    
            </ul>
            <ul v-else class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <!-- <li class="nav-item">
                    <router-link to="/admin/dashboard" class="nav-link">Dashboard</router-link>
                </li> -->
                <li class="nav-item">
                    <router-link to="/login" class="nav-link">Login</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/registration" class="nav-link">Registration</router-link>
                </li>
            </ul>
            </div>
        </nav>
        <!-- /.navbar -->
    </div>
</template>

<script>
export default {
    data() {
        return {
           token : localStorage.getItem('token'),
           currentUser : {}
        }
    },

    methods : {
        logout() {
            // axios.defaults.headers.common["Authorization"] = `Bearer ${this.token}`
            axios.post('/api/logout').then(response => {
               localStorage.removeItem('token')
               localStorage.removeItem('userInfo')
               this.$swal({
                   toast: true,
                   position: 'top-end',
                   showConfirmButton: false,
                   timer: 3000,
                   icon: 'success',
                   title: 'Status',
                   text: 'Logout Successful !',
               })
               this.$router.push('/login')
            }).catch(errors => {
                console.log(errors.response.data)
            })
        }
    },

    created() {
        window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
        axios.get('/api/user').then(response => {
           localStorage.setItem('userInfo', JSON.stringify(response.data))
           let getUser = localStorage.getItem('userInfo')
           this.currentUser = JSON.parse(getUser)
        }).catch(errors => {
            console.log(errors)
        })
    }
}
</script>