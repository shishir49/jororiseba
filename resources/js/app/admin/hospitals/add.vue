<template>
    <div>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Hospital</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><router-link to="/admin/dashboard">Home</router-link></li>
                    <li class="breadcrumb-item active">Add Hospital</li>
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
                        <input type="text" class="form-control" v-model="data.hospital_name" placeholder="Title">
                        <span v-if="allerrors.hospital_name" class="text-danger">{{allerrors.hospital_name[0]}}</span>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <!-- /.form-group -->
                        <div class="form-group">
                        <label>Order</label>
                        <input type="text" class="form-control" v-model="data.hospital_order" placeholder="Order">
                        <span v-if="allerrors.hospital_order">{{allerrors.hospital_order[0]}}</span>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label>District</label>
                            <select v-model="data.district_id" class="form-control" placeholder="District" @change="getThana">
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
                        <label>Thana </label>
                        <select v-model="data.thana_id" name="" id="" class="form-control" placeholder="Thana">
                            <option value="">Select a Thana</option>
                            <option v-for="(thana,i) in thanas" :key="i" :value="thana.id">{{thana.title}}</option>
                        </select>
                        <span v-if="allerrors.thana_id">{{allerrors.thana_id[0]}}</span>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" v-model="data.email" placeholder="Email">
                            <span v-if="allerrors.email">{{allerrors.email[0]}}</span>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label>Phone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" v-model="data.phone" placeholder="Phone">
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
                        <button @click="addHospitals" type="submit" class="btn btn-success">Submit</button>
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
            allerrors : [],
            data : {
                hospital_name : '',
                hospital_order : '',
                district_id : '',
                thana_id : '',
                email : '',
                phone : '',
                status : 1
            },
            district_id : '',
            districts : [],
            thanas : []
        }
    },

    methods : {
        addHospitals() {
            axios.post('/api/add-hospital', this.data).then(respone => {
                this.allerrors = []
                this.data = []
                this.$swal({
                   toast: true,
                   position: 'top-end',
                   showConfirmButton: false,
                   timer: 3000,
                   icon: 'success',
                   title: 'Status',
                   text: 'Hospital Added Successfully !',
               })
            }).catch((error) => {
                this.allerrors = error.response.data.errors
                this.success - false
            })
        },

        getThana() {
            axios.get('/api/get-thana/'+this.data.district_id).then(response => {
               this.thanas = response.data
            })
        }
    },

    // mounted() {
    //     this.getThana()
    // },

    async created() {
        await axios.get('/api/get-district').then(response => {
            this.districts = response.data
        })
    },
}
</script>