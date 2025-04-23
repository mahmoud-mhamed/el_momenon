<script setup>
import ElPanel from "@/Components/Main/ElPanel.vue";
import {ref, watch} from "vue";
import ElFloatingDateRangePicker from "@/Components/Form/ElFloatingDateRangePicker.vue";
import {router, useForm} from "@inertiajs/vue3";
import ElDataStatisticCard from "@/Components/Card/ElDataStatisticCard.vue";

const props = defineProps({
    data: Object,
})
const filter_form=useForm({
    date_range:props.data.date_range,
})

watch(() => filter_form.date_range, (date_range) => {
    router.reload({
        data: {date_range},
        onFinish: () => {
        },
    })
})
</script>

<template>
    <ElPanel>
        <div class="mt-3 mb-3">
            <ElFloatingDateRangePicker :form="filter_form" name="date_range" class="flex-grow  min-w-[200px] max-w-[300px]"/>
        </div>
        <div class="text-center mb-3 text-xl" v-if="data.date_range">
            {{$t('column.date_range')}} : {{data.date_range}}
        </div>
        <aside class="grid md:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-8">
            <ElDataStatisticCard :data="data.expenses"/>
            <ElDataStatisticCard :data="data.salaries"/>
        </aside>
    </ElPanel>
</template>

<style scoped>

</style>
