<script setup>
defineProps({
    title: String,
    value: String,
    icon: String,
    href: {type: String, default: null},
})
</script>

<template>
    <component :is="href?'Link':'div'" :href="href">
        <div class="bg-statistic w-full aspect-[28/7] md:aspect-[18/7] rounded-lg text-primary-300">
            <div class="flex w-full h-full justify-around items-center">
                <div class="flex flex-col items-center justify-center text-2xl">
                    <div class="font-bold md:text-6xl" v-html="value"/>
                    <div v-html="title"/>
                </div>
                <div>
                    <div
                        class="border-4 border-primary-300 rounded-full aspect-square md:w-20 p-2 md:p-4 text-center bg-[#F8EAE7]">
                        <i class="pi md:!text-4xl " v-if="icon" :class="icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </component>

</template>

<style scoped>

</style>
