<template>
    <div class="login row justify-content-center">
        <div class="col-md-6">
            <!-- Default form login -->
            <form class="text-center border border-light p-5" @submit.prevent="authenticate">

                <p class="h4 mb-4">Log in</p>

                <input type="email" v-model="form.email" class="form-control mb-4" placeholder="E-mail">

                <input type="password" v-model="form.password" class="form-control mb-4" placeholder="Password">

                <div class="d-flex justify-content-around">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" v-model="remember">
                        <label class="form-check-label" for="exampleCheck1">Remember me</label>
                    </div>
                    <div>
                        <router-link to="/forgot-password">Forgot password?</router-link>
                    </div>
                </div>

                <button-load :text="'Login'" :loading="loading"></button-load>

                <p>Not a member?
                    <router-link to="/register">Register</router-link>
                </p>
            </form>
        </div>
    </div>
</template>

<script>
    import {login} from '../../helpers/auth';
    import ButtonLoad from '../utility/ButtonLoad.vue';

    export default {
        name: "login",
        data() {
            return {
                form: {
                    email: 'iliuta@test.com',
                    password: '123456'
                },
                remember: 0,
                error: null,
                loading: 0
            };
        },
        methods: {
            authenticate() {
                this.loading = 1;
                this.$store.dispatch('login');

                login(this.$data.form)
                    .then((res) => {
                        this.$store.commit("loginSuccess", res);

                        if(this.remember){
                            this.$store.commit('rememberMe');
                        }

                        this.$router.push({path: '/'});
                    })
                    .catch((error) => {
                        this.$store.commit("loginFailed", {error});
                    });
            }
        },
        computed: {
            authError() {
                return this.$store.getters.authError;
            }
        },
        components:{
            ButtonLoad
        }
    }
</script>

