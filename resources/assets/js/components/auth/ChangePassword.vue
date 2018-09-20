<template>
    <div class="login row justify-content-center">
        <div class="col-md-6">
            <form class="text-center border border-light p-5" @submit.prevent="authenticate">

                <p class="h4 mb-4">Change password</p>

                <input type="password" v-model="form.password" class="form-control mb-4" placeholder="Password">

                <input type="password" v-model="form.password_confirmation" class="form-control mb-4" placeholder="Password confirm">

                <button-load :text="'Change password'" :loading="loading"></button-load>
            </form>
        </div>
    </div>
</template>

<script>
    import ButtonLoad from '../utility/ButtonLoad.vue';

    export default {
        data() {
            return {
                form: {
                    token: '',
                    password: 'bunaziua',
                    password_confirmation: 'bunaziua'
                },
                loading: 0
            };
        },
        methods: {
            authenticate() {
                this.loading=1;
                this.form.token = this.$route.query.token;

                axios.post('/api/auth/password/reset', this.$data.form)
                    .then(response =>{
                        this.loading=0;
                        console.log(response);
                    })
                    .catch(err=>{
                        console.log(err);
                    })
            }
        },
        components:{
            ButtonLoad
        }
    }
</script>

