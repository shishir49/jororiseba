import axios from 'axios';
import { createStore } from 'vuex';
import 'sweetalert2/dist/sweetalert2.min.css';

const store = createStore({
    state() {
        return {
            authenticated : localStorage.getItem('token'),
            hospital_info : {},
            currentUser : JSON.parse(localStorage.getItem('userInfo')),
        }
    },

    getters : {
        authetication(state) {
            return state.authenticated
        },

        get_hospital_info(state) {
            return state.hospital_info
        },

        get_current_user(state) {
            return state.currentUser
        }
    },

    mutations : {
        AUTHENTICATION(state, value) {
            state.authenticated = value
        },

        SINGLE_HOSPITAL(state, value) {
            return state.hospital_info = value
        },

        CURRENT_USER_INFO(state, value) {
            state.currentUser = value
        }
    }, 

    actions : {
        getHospitalById(context, payload) {
            axios.get('/api/single-hospital/'+payload).then(response => {
                console.log(response.data.thanas)
                context.commit('SINGLE_HOSPITAL', response.data.list)
            })
        },

        loginAttempt({commit}, data) {
            axios.post('/api/user-login', data).then(response => {
                localStorage.setItem('token', response.data)
            })
        },
    }
})

export default store