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
                    email: '',
                    password: 'bunaziua',
                    password_confirmation: 'bunaziua'
                },
                loading: 0
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

                this.loading=1;
                axios.post('/api/user/password', this.$data.form)
                    .then(response =>{
                        this.loading=0;
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

