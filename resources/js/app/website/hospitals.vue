<template>
    <div>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Find a Hospital in fastest time here</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-2 list_sidebar">
                            <div class="row p-2">
                               <div class="col-12 mt-2">
                                   <input v-model="hospital_name" type="text" class="form-control" placeholder="Hospital Name">
                               </div>
                                <div class="col-12 mt-2">
                                   <select class="form-control" v-model="district" @change="getThanaList">
                                       <option value="">Select District</option>
                                       <option v-for="(district, i) in districtList" :key="i" :value="district.id">{{ district.title }}</option>
                                   </select>
                               </div>
                               <div class="col-12 mt-2">
                                   <select v-model="thana" class="form-control">
                                       <option value="">Select Thana</option>
                                       <option v-for="(thana, t) in thanaList" :key="t" :value="thana.id">{{ thana.title }}</option>
                                   </select>
                               </div>
                               <div class="col-12 mt-2">
                                   <button @click="searchRequest" type="submit" class="btn btn-warning">Filter</button>
                               </div>
                            </div>
                        </div>    
                        <!-- <div class="row">
                            <div class="col">
                                <select v-model="thana" class="form-control">
                                    <option value="">Select Thana</option>
                                    <option v-for="(thana, t) in thanaList" :key="t" :value="thana.id">{{ thana.title }}</option>
                                </select>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control">
                            </div>    
                        </div> -->
                        <div class="col-10">
                            <div v-if="searchReq == true" class="row">
                                <div v-for="(hospital, i) in searchResult" :key="i" class="col-lg-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title m-0">{{hospital.hospital_name}}</h5>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="card-title">Contact</h6>

                                            <p class="card-text">
                                                <span>Email : {{hospital.email}}</span> 
                                                <br> 
                                                <span>Phone : {{hospital.phone}}</span>
                                            </p>
                                            <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                                        </div>
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col-md-3 -->
                            </div>  
                            <div v-else class="row">
                                <div v-for="(hospital, i) in hospitalList" :key="i" class="col-lg-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title m-0">{{hospital.hospital_name}}</h5>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="card-title">Contact</h6>

                                            <p class="card-text">
                                                <span>Email : {{hospital.email}}</span> 
                                                <br> 
                                                <span>Phone : {{hospital.phone}}</span>
                                            </p>
                                            <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                                        </div>
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col-md-3 -->
                            </div>   
                        </div>    
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            searchReq : false,

            hospitalList : [],

            hospital_name : '',
            district : '',
            thana : '',
            searchResult : [],

            districtList : [],
            thanaList : []
        }
    },

    methods : {
       searchRequest() {
          fetch('/api/search-hospital?hospital_name='+this.hospital_name+'&&district='+this.district+'&&thana='+this.thana)
          .then(response => response.json())
          .then(response => {
              this.searchResult = response
              this.searchReq = true
          })
       },

       getThanaList() {
           if(this.district == '') {
               this.thanaList = ''
           }else{
               axios.get('/api/get-thana/'+this.district).then(response => {
                   console.log(response.data)
                   this.thanaList = response.data
               }).catch(error => {
                   this.thanaList = ''
               })
           }
       }
    },

    created() {
        axios.get('/api/hospital-list')
        .then(response => {
            this.hospitalList = response.data
        })

        axios.get('/api/get-district').then(response => {
            this.districtList = response.data
        })
    }
}
</script>