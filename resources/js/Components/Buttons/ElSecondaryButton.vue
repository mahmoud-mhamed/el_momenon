<template>
    <component :is="href?'Link':'button'" type="button" :href="href"
               class="border border-secondary-500 text-secondary-500 inline-block disabled:opacity-80
    disabled:cursor-progress py-2 px-8 rounded hover:bg-secondary-500 leading-none
    hover:text-white transition-all duration-300 text-sm font-bold" style="white-space:nowrap"
               v-bind="$attrs">
        <span v-if="text" v-text="text"/>
        <slot v-else/>
    </component>
</template>
<script setup>
const props = defineProps({
    text: {
        type: String,
        default: null,
    },
    href: {
        type: String,
        default: null,
    }
})
</script>

<style scoped>

</style>
