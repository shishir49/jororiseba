<template>
    <div>
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <router-link to="/" class="brand-link">
            <!-- <img src="{{ asset( 'back/img/AdminLTELogo.png' )}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
            <span class="brand-text font-weight-light">Jororiseba</span>
            </router-link>

            <!-- Sidebar -->
            <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                <!-- <img src="{{ asset( 'back/img/user2-160x160.jpg' )}}" class="img-circle elevation-2" alt="User Image"> -->
                </div>
                <div class="info">
                <a href="#" v-if="currentUser.name" class="d-block">{{ currentUser.name }}</a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                    <li class="nav-item menu-open">
                        <router-link to="/admin/dashboard" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/admin/add-hospital" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>Add Hospital</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/admin/hospital-list" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Hospital List</p>
                        </router-link>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

    </div>
</template>

<script>
export default {
    data() {
        return {
            currentUser : {},
            token : localStorage.getItem('token'),
        }
    },

    created() {
        window.axios.defaults.headers.common["Authorization"] = `Bearer ${this.token}`;
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