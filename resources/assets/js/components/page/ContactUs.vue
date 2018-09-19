<template>
    <div class="login row justify-content-center">
        <div class="col-md-6">
            <form class="text-center border border-light p-5" @submit.prevent="submit">

                <p class="h4 mb-4">Contact us</p>

                <p class="h5 mb-4">Fill this form with all your suggestions or to get in touch with the Trade4Uni team</p>

                <p class="h5 mb-4">{{ response }}</p>

                <input type="text" v-model="form.name" class="form-control mb-4" placeholder="Name">

                <input type="email" v-model="form.email" class="form-control mb-4" placeholder="E-mail">

                <textarea v-model="form.text" class="form-control mb-4" placeholder="Text..."></textarea>

                <button-load :text="'Submit'" :loading="loading"></button-load>

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
                    email: 'iluta@test.com',
                    name: 'Iliuta Adrian',
                    text: 'Vreau sa fie o pagina de profil!',
                    device: '',
                    browser: ''
                },
                loading: 0,
                response: ''
            };
        },
        methods: {
            submit() {
                this.form.device = navigator.userAgent;
                this.form.browser = this.browserDetect();

                this.loading = 1;
                axios.post('/api/auth/contact-us', this.$data.form)
                    .then(res =>{
                        this.response = res.data;

                        this.loading = 0;
                    });
            },

            browserDetect(){
                var isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
                var isFirefox = typeof InstallTrigger !== 'undefined';
                var isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || (typeof safari !== 'undefined' && safari.pushNotification));
                var isIE = /*@cc_on!@*/false || !!document.documentMode;
                var isEdge = !isIE && !!window.StyleMedia;
                var isChrome = !!window.chrome && !!window.chrome.webstore;

                if(isOpera)
                    return 'opera';
                if(isChrome)
                    return 'chrome';
            }

        },
        components:{
            ButtonLoad
        }
    }
</script>

