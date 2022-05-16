<template>
    <div>
        <div class="login-box">
            <div class="login-logo">
                <router-link to="/"><b>Jororiseba</b></router-link>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <div class="input-group mt-3">
                    <input type="email" v-model="data.email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mt-3">
                    <input type="password" v-model="data.password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                <!-- <div class="col-8">
                    <div class="icheck-primary">
                    <input type="checkbox" id="remember">
                    <label for="remember">
                        Remember Me
                    </label>
                    </div>
                </div> -->
                <!-- /.col -->
                <div class="col-4">
                    <button @click="login" type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
                <div class="col-12 mt-2">
                    <table border="1" class="table table-bordered table-striped">
                        <tr>
                            <td colspan="2">Demo Admin <button class="btn btn-success btn-sm" @click="copyCredential()">copy</button></td>
                        </tr>
                        <tr>
                            <td>User Name</td>
                            <td>admin@yahoo.com</td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td>987654321</td>
                        </tr>
                    </table>
                </div>
                <!-- /.col -->
                </div>

                <!-- <div class="social-auth-links text-center mb-3">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div> -->
                <!-- /.social-auth-links -->

                <!-- <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p> -->
                <p class="mb-0">
                    <router-link to="/registration" class="text-center">Register a new membership</router-link>
                </p>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->
    </div>
</template>

<script>

export default {
    data() {
        return {
            errorMessage : '',
            data : {
                email : '',
                password : '',
                device_name : 'browser'
            },
            errors : {}
        }
    },

    methods : {
        login : function({commit}) {
            this.$store.dispatch('loginAttempt', this.data).then(response => {
                this.$router.push('/admin/dashboard')
                this.$swal({
                   toast: true,
                   position: 'top-end',
                   showConfirmButton: false,
                   timer: 3000,
                   icon: 'success',
                   title: 'Success',
                   text: 'Login Successful !',
               })
             }).catch((errors) => {
                this.errors = errors.response.data.error
                this.$swal({
                   toast: true,
                   position: 'top-end',
                   showConfirmButton: false,
                   timer: 3000,
                   icon: 'error',
                   title: 'Failed',
                   text: 'Incorrect Login Credential !',
               })
            })
        },

        copyCredential() {
            this.data.email = 'admin@yahoo.com'
            this.data.password = '987654321'
        }
    }
}
</script>

