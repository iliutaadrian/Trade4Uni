<template>
    <div class="container">
        <p>Upload or select an old avatar</p>

        <vue-avatar
                :width=150
                :height=150
                :border=10
                ref="vueavatar"
                @vue-avatar-editor:image-ready="onImageReady"
        >
        </vue-avatar>
        <vue-avatar-scale
                ref="vueavatarscale"
                @vue-avatar-editor-scale:change-scale="onChangeScale"
                :width=170
                :min=1
                :max=3
                :step=0.02
        >
        </vue-avatar-scale>

        <div class="images">
            <img v-for="image in images" :src="`/storage/${image}`" class="image" @click="updatePreview(image)">
        </div>

        <br>
        <button class="btn btn-info" @click="saveClicked">Change Picture</button>
        <button class="btn btn-info" @click="done">Cancel</button>
        <br>
    </div>

</template>

<script>
    import VueAvatar from './avatar-editor/VueAvatar'
    import VueAvatarScale from './avatar-editor/VueAvatarScale'

    export default {
        components: {
            VueAvatar,
            VueAvatarScale
        },
        data(){
            return{
                images: [],
                preview: ''
            }
        },
        created(){
            axios.get('/api/user/pictures/1')
            .then((res)=>{
                this.images = res.data.pictures;
            })
        },
        methods:{
            onChangeScale (scale) {
                this.$refs.vueavatar.changeScale(scale)
            },
            saveClicked(){
                var img = this.$refs.vueavatar.getImageScaled();
                const formData = new FormData();

                formData.append('image', img.toDataURL());
                formData.append('id', this.$store.getters.currentUser.id);

                axios.post('/api/user/avatar', formData)
                    .then(res=>{
                        this.$store.getters.currentUser.avatar = res.data.path;
                        this.$store.commit('updateUser', this.$store.getters.currentUser);

                        this.$emit('doneAvatar');
                    })
                    .catch(err=>{

                    })

            },
            onImageReady(scale){
                this.$refs.vueavatarscale.setScale(scale)
            },
            done(){
                this.$emit('doneAvatar');
            },
            updatePreview(image){
                this.$store.getters.currentUser.avatar = '/storage/' + image;
                this.$store.commit('updateUser', this.$store.getters.currentUser);

                this.$emit('doneAvatar');
            }
        }
    }
</script>

<style scoped>
    .images{
        height: 160px;
        overflow-y: scroll;
        float: left;
        overflow-x: hidden;
    }

    .image{
        margin: 7px;
        border: 1px solid black;
        cursor: pointer;
     }
</style>