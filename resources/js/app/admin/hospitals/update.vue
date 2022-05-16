<template>
    <div>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Hospital</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><router-link to="/admin/dashboard">Home</router-link></li>
                    <li class="breadcrumb-item active">Update Hospital</li>
                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Inputs with (*) mark is compulsory</h3>
                    
                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-6">
                        <!-- /.form-group -->
                        <div class="form-group">
                        <label>Hospital Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" v-model="getHospitalById.hospital_name" placeholder="Title">
                        <span v-if="allerrors.hospital_name" class="text-danger">{{allerrors.hospital_name[0]}}</span>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <!-- /.form-group -->
                        <div class="form-group">
                        <label>Order</label>
                        <input type="text" class="form-control" v-model="getHospitalById.hospital_order" placeholder="Order">
                        <span v-if="allerrors.hospital_order">{{allerrors.hospital_order[0]}}</span>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label>District</label>
                            <select v-model="getHospitalById.district_id" class="form-control" placeholder="District" @change="getThana">
                                <option value="">Select A District</option>
                                <option v-for="(district,i) in districts" :key="i" :value="district.id"> {{district.title}}</option>
                            </select>
                            <span v-if="allerrors.district_id">{{allerrors.district_id[0]}}</span>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label>Thana <span class="text-danger">*</span></label>
                            <select v-if="district_clicked == false" v-model="getHospitalById.thana_id" class="form-control" placeholder="Thana">
                                <option value="">Select a Thana</option>
                                <option v-for="(thana,i) in thanaList" :key="i" :value="thana.id">{{thana.title}}</option>
                            </select>
                            <select v-else v-model="getHospitalById.thana_id" class="form-control" placeholder="Thana">
                                <option value="">Select a Thana</option>
                                <option v-for="(thana,i) in thanas" :key="i" :value="thana.id">{{thana.title}}</option>
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" v-model="getHospitalById.email" placeholder="Email">
                            <span v-if="allerrors.email">{{allerrors.email[0]}}</span>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label>Phone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" v-model="getHospitalById.phone" placeholder="Phone">
                            <span v-if="allerrors.phone" class="text-danger">{{allerrors.phone[0]}}</span>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                    <!-- /.col -->
                    <div class="col-md-3">
                        <!-- /.form-group -->
                        <div class="form-group">
                        <button @click="updateHospitals" type="submit" class="btn btn-success">Update</button>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
                    the plugin.
                </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.container-fluid -->
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
            district_clicked : false,
            allerrors : [],
            hospitalInfo : [],
            district_id : '',
            thanaList : [],
            districts : [],
            thanas : []
        }
    },

    methods : {
        async updateHospitals() {
            await axios.post('/api/update-hospital/'+this.$route.params.id, this.getHospitalById).then(respone => {
                this.allerrors = []
                this.data = []
                this.$swal({
                   toast: true,
                   position: 'top-end',
                   showConfirmButton: false,
                   timer: 3000,
                   icon: 'success',
                   title: 'Status',
                   text: 'Hospital Updated Successfully !',
               })
            }).catch((error) => {
                this.allerrors = error.response.data.errors
                this.success - false
            })
        },

        getThana() {
            axios.get('/api/get-thana/'+this.getHospitalById.district_id).then(response => {
                console.log(response.data)
               this.thanas = response.data
               this.district_clicked = true
            })
        }
    },

    mounted() {
       this.$store.dispatch('getHospitalById', this.$route.params.id)
    },

    computed : {
        getHospitalById() {
            return this.$store.getters.get_hospital_info
        },
    },

    async created() {
        await axios.get('/api/get-district').then(response => {
            this.districts = response.data
        })

        await axios.get('/api/single-hospital/'+this.$route.params.id)
        .then(response => {
            this.thanaList = response.data.thanas
        })
        
    },
}
</script>