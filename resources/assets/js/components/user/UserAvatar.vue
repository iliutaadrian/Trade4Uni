<template>
    <div class="container">
        <img :src="avatar" style="width: 140px">

        <input type="file" @change="getImage" accept="image/*"/>
        <button class="btn btn-info" type="submit" :disabled="loading == 1" @click="uploadAvatar">
            <i class="fa fa-spinner fa-spin" style="font-size:18px" v-if="loading"></i> Update Info
        </button>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                avatar: this.$store.getters.currentUser.avatar,
                loading: 0,
                file: ''
            }
        },
        methods: {
            getImage(event){
                this.file = event.target.files[0];
            },
            uploadAvatar(){
                this.loading=1;

                var formData = new FormData();
                formData.append('image', this.file);
                formData.append('id', this.$store.getters.currentUser.id);

                axios.post('/api/user/avatar', formData)
                    .then(res=>{
                        this.loading=0
                    })
                    .catch(err=>{
                        this.loading=0;
                    })
            }
        }
    }
</script>