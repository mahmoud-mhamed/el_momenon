<template>
    <component :is="href?(isA?'a':'Link'):'button'"
               class="bg-primary-500 inline-block leading-none disabled:opacity-20 disabled:cursor-progress text-white py-3 px-8
     rounded hover:bg-primary-400 transition-all duration-300 text-sm font-bold" v-bind="$attrs" :href="href" style="white-space: nowrap;">
        <span v-if="text" v-text="text"/>
        <slot v-else/>
    </component>
</template>

<script setup>
const props = defineProps({
    text: {
        type:String,
        default:null,
    },
    href: {
        type:String,
        default:null,
    },
    isA:{
        type:Boolean,
        default:false,
    }
})
</script>

<style scoped>

</style>
