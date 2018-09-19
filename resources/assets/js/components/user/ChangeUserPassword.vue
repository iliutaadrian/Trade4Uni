<template>
    <div class="login row justify-content-center">
        <div class="col-md-6">
            <form class="text-center border border-light p-5" @submit.prevent="authenticate">

                <p class="h4 mb-4">Change password</p>

                <input type="password" v-model="form.password" class="form-control mb-4" placeholder="Password">

                <input type="password" v-model="form.password_confirmation" class="form-control mb-4" placeholder="Password confirm">

                <button class="btn btn-info btn-block my-4" type="submit">Change password</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "login",
        data() {
            return {
                form: {
                    email: '',
                    password: 'bunaziua',
                    password_confirmation: 'bunaziua'
                }
            };
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser
            }
        },
        methods: {
            authenticate() {
                this.form.email = this.currentUser.email;

                axios.post('/api/user/password', this.$data.form)
                    .then(response =>{
                        this.$router.push('/user-profile');
                    })
                    .catch(err=>{
                        console.log(err);
                    })

            }
        }
    }
</script>

