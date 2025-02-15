<script setup>

import ElPanel from "@/Components/Main/ElPanel.vue";
import ElDataStatisticCard from "@/Components/Card/ElDataStatisticCard.vue";

const props = defineProps({
    data: {type: Object},
});
</script>

<template>
    <ElPanel>
        <section class="grid gap-8">
            <aside class="grid grid-cols-4 gap-8">
                <ElDataStatisticCard :data="data.users"/>
                <ElDataStatisticCard :data="data.clients"/>
                <ElDataStatisticCard :data="data.currencies"/>
                <ElDataStatisticCard :data="data.suppliers"/>
            </aside>
        </section>
    </ElPanel>
</template>

<style scoped>

</style>
