<template>
    <div class="login row justify-content-center">
        <div class="col-md-6">
            <!-- Default form login -->
            <form class="text-center border border-light p-5" @submit.prevent="authenticate">

                <p class="h4 mb-4">Log in</p>

                <input type="email" v-model="form.email" class="form-control mb-4" placeholder="E-mail">

                <input type="password" v-model="form.password" class="form-control mb-4" placeholder="Password">

                <div class="d-flex justify-content-around">
                    <div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="defaultLoginFormRemember">
                            <label class="custom-control-label" for="defaultLoginFormRemember">Remember me</label>
                        </div>
                    </div>
                    <div>
                        <router-link to="/forgot-password">Forgot password?</router-link>
                    </div>
                </div>

                <button class="btn btn-info btn-block my-4" type="submit">Sign in</button>

                <p>Not a member?
                    <router-link to="/register">Register</router-link>
                </p>
            </form>
        </div>
    </div>
</template>

<script>
    import {login} from '../../helpers/auth';

    export default {
        name: "login",
        data() {
            return {
                form: {
                    email: 'iliuta@test.com',
                    password: '123456'
                },
                error: null
            };
        },
        methods: {
            authenticate() {
                this.$store.dispatch('login');

                login(this.$data.form)
                    .then((res) => {
                        this.$store.commit("loginSuccess", res);
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
        }
    }
</script>

