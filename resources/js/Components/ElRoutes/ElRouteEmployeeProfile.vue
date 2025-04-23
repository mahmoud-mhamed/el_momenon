<template>
    <ElRoute v-if="model?.id" :href="route('dashboard.employee.employee-salary',model.id)" :ability="Ability.M_EMPLOYEE_SALARY_INDEX">
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
