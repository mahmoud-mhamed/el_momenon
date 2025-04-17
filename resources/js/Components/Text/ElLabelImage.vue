<template>
    <div class="flex gap-2">
        <label v-if="label">{{ label }} : </label>
        <Image width="50" v-if="src" :src="src" preview/>
        <img width="50" v-else :src="asset('images/main/no_image.png')"/>
    </div>
</template>

<script setup>
import Image from 'primevue/image';
import {asset} from "@/Helpers/Functions.js";
const props = defineProps({
    label: {type: String, default: null},
    src: {type: String, default: null},
})
</script>


<style scoped>

</style>
