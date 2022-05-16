<template>
    <div>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ hospitalNumber }}</h3>

                            <p>Total Hospitals {{ currentUser.name }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">Learn More<i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
</template>

<script>
export default {
    data() {
        return {
           currentUser : {},
           token : localStorage.getItem('token'),
           hospitalNumber : ''
        }
    },

    created() {
        axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
        axios.get('/api/user').then(response => {
           localStorage.setItem('userInfo', JSON.stringify(response.data))
        }).catch(errors => {
            console.log(errors)
        })

        axios.get('/api/dashboard').then(response => {
            this.hospitalNumber = response.data
        })
    }
}
</script>
