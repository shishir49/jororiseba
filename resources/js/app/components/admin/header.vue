<template>
    <div>
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <router-link to="/" class="nav-link">Home</router-link>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                
                <!-- User Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <button @click="logout()" type="button" class="dropdown-item text-right">
                            Logout
                        </button>
                    </div>
                </li>
                 <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" v-if="currentUser.name" class="nav-link">{{ currentUser.name }}</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
    </div>
</template>

<script>
import {defineComponent} from 'vue'
import 'sweetalert2/dist/sweetalert2.min.css';

export default defineComponent({
    data() {
        return {
            token : localStorage.getItem('token'),
            currentUser : {}
        }
    },

    methods : {
        logout() {
            axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
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

    mounted() {
        
    },

    created() {
        window.axios.defaults.headers.common["Authorization"] = `Bearer ${this.token}`;
        axios.get('/api/user').then(response => {
           localStorage.setItem('userInfo', JSON.stringify(response.data))
           let getUser = localStorage.getItem('userInfo')
           this.currentUser = JSON.parse(getUser)
        }).catch(errors => {
            // console.log(errors)
        })
    }

})
</script>
