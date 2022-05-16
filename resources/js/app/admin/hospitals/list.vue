<template>
    <div>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Hospital List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Hospital List</li>
                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
            <div class="container-fluid">
                <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-3">
                                <input type="text" v-model="hospital_name" class="form-control" placeholder="By Name">
                            </div>
                            <div class="col-3">
                                <select v-model="district" class="form-control" @change="getThana">
                                    <option value="">Select District</option>
                                    <option v-for="(district,d) in districtList" :key="d" :value="district.id">{{district.title}}</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <select v-model="thana" class="form-control">
                                    <option value="">Select Thana</option>
                                    <option v-for="(thana,t) in thanaList" :key="t" :value="thana.id">{{thana.title}}</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <button @click="hospitalList" type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table v-if="showSearch == true" id="features" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Hospital Name</th>
                                    <th>District</th>
                                    <th>Thana</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Order</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody v-if="searchResult.length>0">
                                <tr v-for="(hospital, i) in searchResult" :key="i">
                                    <td>{{i}}</td>
                                    <td>{{hospital.hospital_name}}</td>
                                    <td>{{hospital.districts.title}}</td>
                                    <td>{{hospital.thanas.title}}</td>
                                    <td>{{hospital.email}}</td>
                                    <td>{{hospital.phone}}</td>
                                    <td>{{hospital.hospital_order}}</td>
                                    <td>
                                        <router-link :to="/update-hospital/ + `${hospital.id}`"><i class="fa fa-edit text-primary"></i></router-link>
                                        <i @click="showDeleteModal(hospital, i)" data-toggle="modal" data-target="#deleteModal" class="fa fa-trash text-danger ml-2"></i>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="8" class="text-center"><span>No data Available</span></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Serial</th>
                                    <th>Hospital Name</th>
                                    <th>District</th>
                                    <th>Thana</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Order</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                        <table v-else id="features" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Hospital Name</th>
                                    <th>District</th>
                                    <th>Thana</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Order</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody v-if="hospitals.length>0">
                                <tr v-for="(hospital, i) in hospitals" :key="i">
                                    <td>{{i}}</td>
                                    <td>{{hospital.hospital_name}}</td>
                                    <td>{{hospital.districts.title}}</td>
                                    <td>{{hospital.thanas.title}}</td>
                                    <td>{{hospital.email}}</td>
                                    <td>{{hospital.phone}}</td>
                                    <td>{{hospital.hospital_order}}</td>
                                    <td>
                                        <router-link :to="/update-hospital/ + `${hospital.id}`"><i class="fa fa-edit text-primary"></i></router-link>
                                        <i @click="showDeleteModal(hospital, i)" data-toggle="modal" data-target="#deleteModal" class="fa fa-trash text-danger ml-2"></i>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr v-for="(hospital, i) in hospitals" :key="i">
                                    <td>No data Available</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Serial</th>
                                    <th>Hospital Name</th>
                                    <th>District</th>
                                    <th>Thana</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Order</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            </section>
            <!-- /.content -->

            <!-- Delete Modal -->

            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modalheadline" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalheadline">Delete Employee</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete {{deletingItemData.hospital_name}}?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                            <button @click="deleteHospital" type="button" data-dismiss="modal" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->
    </div>
</template>

<script>
export default {
    data() {
        return {
           hospitals : [], 
           searchResult : [],
           showSearch : false,

           deleteModalCall : true,
           deletingItemData : {},

           districtList : [],
           thanaList : [],
           hospital_name : '',
           district : '',
           thana : ''
        }
    },
    
    methods : {
        hospitalList() {
           fetch('/api/search-hospital?hospital_name='+this.hospital_name+'&&district='+this.district+'&&thana='+this.thana)
           .then(res => res.json())
           .then(res => {
               this.searchResult = res
               this.showSearch = true
           })
        },

        getThana() {
            axios.get('/api/get-thana/'+this.district).then(response => {
               this.thanaList = response.data
            })
        },

        // Display Data in Delete Modal 

        showDeleteModal(hospital, i) {
            this.deletingItemData = hospital
            this.i = i
        },

        // Delete Item

        async deleteHospital() {
            await axios.post('/api/delete-hospital/'+this.deletingItemData.id).then(response => {
                this.hospitals.splice(this.i,1)
                this.searchResult.splice(this.i,1)
                this.$swal({
                   toast: true,
                   position: 'top-end',
                   showConfirmButton: false,
                   timer: 3000,
                   icon: 'success',
                   title: 'Status',
                   text: 'Hospital Deleted Successfully !',
               })
            }).catch((error) => {
                this.deleteSuccess = false
            })
        }
    },

    mounted() {

    },

    async created() {
        await axios.get('/api/hospital-list').then(response => {
            this.hospitals = response.data
        })

        await axios.get('/api/get-district').then(response => {
            this.districtList = response.data
        })
    }
}
</script>