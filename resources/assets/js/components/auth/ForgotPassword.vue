<template>
    <div class="login row justify-content-center">
        <div class="col-md-6">
            <form class="text-center border border-light p-5" @submit.prevent="authenticate">

                <p class="h4 mb-4">Send email to reset password</p>

                <input type="email" v-model="form.email" class="form-control mb-4" placeholder="Email">

                <button-load :text="'Send mail'" :loading="loading"></button-load>

            </form>
        </div>
    </div>
</template>

<script>
    import ButtonLoad from '../utility/ButtonLoad.vue';

    export default {
        name: "login",
        data() {
            return {
                form: {
                    email: 'iliuta@test.com',
                },
                loading: 0
            };
        },
        methods: {
            authenticate() {
                this.loading=1;
                axios.post('/api/auth/password/email', this.$data.form)
                    .then(res=>{
                        this.loading=0;
                        console.log(res);
                    })
                    .catch(err=>{
                        this.loading=0;
                        console.log(err);
                    })
            }
        },
        components:{
            ButtonLoad
        }
    }
</script>

