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
                    token: '',
                    password: 'bunaziua',
                    password_confirmation: 'bunaziua'
                }
            };
        },
        methods: {
            authenticate() {
                this.form.token = this.$route.query.token;

                axios.post('/api/auth/password/reset', this.$data.form)
                    .then(response =>{
                        console.log(response);
                    })
                    .catch(err=>{
                        console.log(err);
                    })

            }
        }
    }
</script>

