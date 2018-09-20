<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <p class="h4 mb-4">Profile: {{ currentUser.name }}</p>

                <p class="h6 mb-4">{{ response }}</p>

                <div class="form-row mb-4">
                    <div class="col">
                        <input type="email" :value="currentUser.email" class="form-control" placeholder="E-mail" readonly>
                    </div>
                </div>

                <div class="form-row mb-4">
                    <div class="col">
                        <input type="text" v-model="currentUser.phone" class="form-control" placeholder="Phone number" aria-describedby="defaultRegisterFormPhoneHelpBlock">
                    </div>
                </div>

                <div class="form-row mb-4">
                    <div class="col">
                        <select name="city" v-model="currentUser.idCity" class="form-control">
                            <option value="0" disabled selected>Select your city</option>
                            <option value="1">UMF Iasi</option>
                        </select>
                    </div>
                </div>

                <div class="form-row mb-4">
                    <div class="col">
                        <select name="college" v-model="currentUser.idCollege" class="form-control" >
                            <option value="0" disabled selected>Select your college</option>
                            <option value="1">Iasi</option>
                        </select>
                    </div>
                </div>

                <button @click="update" class="btn btn-info">Update Info</button>

                <button @click="logout" class="btn btn-info">Logout</button>

                <router-link to="/user-change-password" class="btn btn-info">Change Password</router-link>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data(){
            return {
                response: ''
            }
        },
        methods: {
            logout() {
                this.$store.commit('logout');
                this.$router.push('/login');
            },
            update(){
                axios.post('/api/user/update', this.currentUser)
                    .then(res=>{
                        this.response = res.data.data;
                        this.$store.commit('updateUser', this.currentUser);
                    })
            }
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser
            }
        }
    }
</script>
