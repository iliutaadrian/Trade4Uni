<template>
    <div class="login row justify-content-center">
        <div class="col-md-6">
            <form class="text-center border border-light p-5" @submit.prevent="authenticate">

                <p class="h4 mb-4">Send email to reset password</p>

                <input type="email" v-model="form.email" class="form-control mb-4" placeholder="Email">

                <button class="btn btn-info btn-block my-4" type="submit">Send Email</button>
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
                    email: 'iliuta@test.com',
                }
            };
        },
        methods: {
            authenticate() {
                axios.post('/api/auth/password/email', this.$data.form)
                    .then(res=>{
                        console.log(res);
                    })
            }
        }
    }
</script>

