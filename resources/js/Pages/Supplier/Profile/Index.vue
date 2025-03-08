<template>
    <ElPanel>
        <ElProfile>
            <template #header>
                <Header/>
            </template>

            <template #tabContent>
                <component :is="tapComponent[$page.props.tap_component]" :data="data"/>
            </template>
        </ElProfile>
    </ElPanel>

</template>
<script setup>
import ElProfile from "@/Components/Profile/ElProfile.vue";

import Header from "./Header.vue";
import BillTab from "./BillTab.vue";
import PaymentTab from "./PaymentTab.vue";

const tapComponent = {
    'BillTab': BillTab,
    'PaymentTab': PaymentTab,
};
const props = defineProps({
    data: {
        type: Object,
        default: []
    },
})

</script>

