<script setup>

import ElPanel from "@/Components/Main/ElPanel.vue";
import ElDataStatisticCard from "@/Components/Card/ElDataStatisticCard.vue";
import ElChartCard from "@/Components/Charts/ElChartCard.vue";
import ElSearchInput from "@/Components/Form/ElSearchInput.vue";
import ElCardWithTitle from "@/Components/Card/ElCardWithTitle.vue";
import BillTable from "@/Pages/Bill/BillTable.vue";
import ElDataTable from "@/Components/Table/ElDataTable.vue";

const props = defineProps({
    data: {type: Object},
});
</script>

<template>
    <ElPanel>
        <section class="grid gap-3 md:gap-8">
            <aside class="grid md:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-8">
                <ElDataStatisticCard :data="data.users"/>
                <ElDataStatisticCard :data="data.clients"/>
                <ElDataStatisticCard :data="data.currencies"/>
                <ElDataStatisticCard :data="data.suppliers"/>
                <ElCardWithTitle class="col-span-full">
                    <template #title>
                        {{ $t('message.search_for_car') }}
                        <span class="ms-3">
                            <ElSearchInput/>
                        </span>
                    </template>
                    <section v-if="data.search_key">
                        <BillTable :empty-is-large="false" :rows="props.data.bills"/>
                    </section>
                </ElCardWithTitle>
                <ElChartCard class="md:col-span-2" :data="data" name="ClientInCurrentYearBarChart"/>
                <ElChartCard class="md:col-span-2" :data="data" name="BillInCurrentYearBarChart"/>
            </aside>
        </section>
    </ElPanel>
</template>

<style scoped>

</style>
