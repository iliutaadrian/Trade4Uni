<template>
    <div id="main">
        <Header/>

        <div class="content">
            <router-view></router-view>
        </div>

        <Footer></Footer>
    </div>
</template>

<script>
    import Header from './page/Header.vue';
    import Footer from "./page/Footer.vue";

    export default {
        name: 'main-app',
        components: {Footer, Header}
    }
</script>
