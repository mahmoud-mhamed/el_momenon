<template>
    <ElRoute v-if="model?.id" :href="route('dashboard.bill.profile.main_data',model.id)">
        <template #title>{{model.name}}</template>
    </ElRoute>
</template>

<script setup>
import ElRoute from "@/Components/ElRoutes/ElRoute.vue";

const props = defineProps({
    model: {type: Object, default: null},
})
</script>


<style scoped>

</style>
