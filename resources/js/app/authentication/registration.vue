<template>
    <div>
        <div class="register-box">
            <div class="register-logo">
                <router-link to="/"><b>Jororiseba</b></router-link>
            </div>

            <div class="card">
                <div class="card-body register-card-body">
                <p class="login-box-msg">Register a new membership</p>

                <div class="input-group mt-3">
                    <input type="text" class="form-control" v-model="data.name" placeholder="Full name">

                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <span class="text-danger" v-if="allerrors.name">{{allerrors.name[0]}}</span>
                <div class="input-group mt-3">
                    <input type="email" class="form-control" v-model="data.email" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <span class="text-danger" v-if="allerrors.email">{{allerrors.email[0]}}</span>
                <div class="input-group mt-3">
                    <input type="password" class="form-control" v-model="data.password" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <span class="text-danger" v-if="allerrors.password">{{allerrors.password[0]}}</span>
                <div class="input-group mt-3">
                    <input type="password" class="form-control" v-model="data.confirm_password" placeholder="Retype password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <span class="text-danger" v-if="allerrors.confirm_password">{{allerrors.confirm_password[0]}}</span>
                <div class="row mt-3">
                <div class="col-8">
                    <!-- <div class="icheck-primary">
                    <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                    <label for="agreeTerms">
                    I agree to the <a href="#">terms</a>
                    </label>
                    </div> -->
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button @click="registration" type="submit" class="btn btn-primary btn-block">Register</button>
                </div>
                <!-- /.col -->
                </div>

                <!-- <div class="social-auth-links text-center">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i>
                    Sign up using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i>
                    Sign up using Google+
                    </a>
                </div> -->

                <router-link to="/login" class="text-center">I already have a membership</router-link>
                </div>
                <!-- /.form-box -->
            </div><!-- /.card -->
            </div>
            <!-- /.register-box -->
    </div>
</template>

<script>
export default {
   data() {
       return {
           allerrors : [],
           data : {
               name : '',
               email : '',
               password : '',
               confirm_password : ''
           }
       }
   },

   methods : {
       async registration() {
           const registration = await axios.post('/api/user-registration', this.data).then(response => {
               this.allerrors = []
               this.$swal({
                   toast: true,
                   position: 'top-end',
                   showConfirmButton: false,
                   timer: 3000,
                   icon: 'success',
                   title: 'Success',
                   text: 'Registration Successful !',
               })
               this.$router.push('/login')
           }).catch((error) => {
               this.allerrors = error.response.data.error
           })
       }
   }
}
</script>
