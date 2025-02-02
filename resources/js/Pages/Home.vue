<script setup>

const props = defineProps({
    data: {type: Object},
});
</script>

<template>
    <section class="text-4xl text-center  mt-5">
        {{ $t('message.home_message') }}
    </section>
</template>

<style scoped>

</style>
