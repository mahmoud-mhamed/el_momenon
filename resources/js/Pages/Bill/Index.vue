<script setup>
import ElPanel from "@/Components/Main/ElPanel.vue";
import ElDataTable from "@/Components/Table/ElDataTable.vue";
import Column from 'primevue/column';
import {Ability} from "@/ability.js";
import ElPrimaryButton from "@/Components/Buttons/ElPrimaryButton.vue";
import {ref} from "vue";
import Dialog from "primevue/dialog";
import ElActionMenu from "@/Components/ActionMenu/ElActionMenu.vue";
import ElActionMenuDeleteAction from "@/Components/ActionMenu/ElActionMenuDeleteAction.vue";
import ElText from "@/Components/Text/ElText.vue";
import ElPrice from "@/Components/Text/ElPrice.vue";
import ElActionMenuEdit from "@/Components/ActionMenu/ElActionMenuEdit.vue";
import ElRouteSupplierProfile from "@/Components/ElRoutes/ElRouteSupplierProfile.vue";
import SupplierFormCreateUpdate from "@/Pages/Supplier/SupplierFormCreateUpdate.vue";
import ElRouteBillProfile from "@/Components/ElRoutes/ElRouteBillProfile.vue";
import ElRouteClientProfile from "@/Components/ElRoutes/ElRouteClientProfile.vue";
import BillTable from "@/Pages/Bill/BillTable.vue";

const props = defineProps({
    data: Object,
})
</script>

<template>
    <ElPanel>
        <template #actions>
            <el-primary-button :href="route('dashboard.bill.create')" v-ability="Ability.M_BILL_CREATE"
                               :text="$t('message.add_new')"/>
        </template>
        <BillTable :rows="props.data.rows"/>
    </ElPanel>
</template>

<style scoped>

</style>
