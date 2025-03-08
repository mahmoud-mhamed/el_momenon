<template>
    <ElRoute v-if="model?.id" :ability="Ability.M_SUPPLIER_BILLS" :href="route('dashboard.supplier.profile.view-bills',model.id)">
        <template #title> {{ model.name }}</template>
    </ElRoute>
    <ElText v-else/>
</template>

<script setup>
import ElRoute from "@/Components/ElRoutes/ElRoute.vue";
import {Ability} from "@/ability.js";

const props = defineProps({
    model: {type: Object, default: null},
})
</script>


<style scoped>

</style>
