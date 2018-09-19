<template>
    <button class="btn btn-info" type="submit" style="margin: 15px; width:250px" :disabled="loading == 1">
        <i class="fa fa-spinner fa-spin" style="font-size:18px" v-if="loading"></i> {{text}}
    </button>
</template>

<script>
    export default {
        props:{
            text:'',
            loading: 0
        }
    }
</script>
