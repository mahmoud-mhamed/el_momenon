<script setup>
import ElDataTable from "@/Components/Table/ElDataTable.vue";
import Column from 'primevue/column';
import {Ability} from "@/ability.js";
import ElActionMenu from "@/Components/ActionMenu/ElActionMenu.vue";
import ElActionMenuDeleteAction from "@/Components/ActionMenu/ElActionMenuDeleteAction.vue";
import ElText from "@/Components/Text/ElText.vue";
import ElPrice from "@/Components/Text/ElPrice.vue";
import ElActionMenuEdit from "@/Components/ActionMenu/ElActionMenuEdit.vue";
import ElRouteSupplierProfile from "@/Components/ElRoutes/ElRouteSupplierProfile.vue";
import ElRouteBillProfile from "@/Components/ElRoutes/ElRouteBillProfile.vue";
import ElRouteClientProfile from "@/Components/ElRoutes/ElRouteClientProfile.vue";
import BillPrint from "@/Pages/Bill/BillPrint.vue";
import ElActionMenuItem from "@/Components/ActionMenu/ElActionMenuItem.vue";
import {ref} from "vue";

const props = defineProps({
    rows: Object,
});
const rep_print_bill=ref();
</script>

<template>
    <ElDataTable :src="props.rows" v-bind="$attrs">
        <Column :header="$t('column.id')">
            <template #body="row">
                <ElRouteBillProfile :model="row.data"/>
            </template>
        </Column>
        <Column :header="$t('column.supplier_id')">
            <template #body="row">
                <ElRouteSupplierProfile :model="row.data.supplier"/>
            </template>
        </Column>
        <Column :header="$t('column.client_id')">
            <template #body="row">
                <ElRouteClientProfile :model="row.data.client"/>
            </template>
        </Column>
        <Column :header="$t('column.disabled_client_id')">
            <template #body="row">
                <ElText :model="row.data.disabled_name"/>
                <div v-if="row.data.disabled_national_id">
                    <ElText :model="row.data.disabled_national_id"/>
                </div>
            </template>
        </Column>
        <Column :header="$t('column.purchase_type')">
            <template #body="row">
                <ElText :value="row.data.purchase_type_text"/>
            </template>
        </Column>
        <Column :header="$t('column.car_type')">
            <template #body="row">
                <ElText :value="row.data.car_type"/>
            </template>
        </Column>
        <Column :header="$t('column.chassis_number')">
            <template #body="row">
                <ElText :value="row.data.chassis_number"/>
            </template>
        </Column>
        <Column :header="$t('column.purchase_price')">
            <template #body="row">
                <ElPrice :currency="row.data.currency" :value="row.data.purchase_price"/>
            </template>
        </Column>
        <Column :header="$t('column.supplier_paid_amount')">
            <template #body="row">
                <ElPrice :currency="row.data.currency" :value="row.data.supplier_paid_amount"/>
            </template>
        </Column>
        <Column :header="$t('column.supplier_rent_amount')">
            <template #body="row">
                <ElPrice :currency="row.data.currency" :value="row.data.supplier_rent_amount"/>
            </template>
        </Column>
        <Column :header="$t('column.selling_price')">
            <template #body="row">
                <ElPrice :currency="row.data.currency" :value="row.data.selling_price"/>
            </template>
        </Column>
        <Column :header="$t('column.client_paid_amount')">
            <template #body="row">
                <ElPrice :currency="row.data.currency" :value="row.data.client_paid_amount"/>
            </template>
        </Column>
        <Column :header="$t('column.client_rent_amount')">
            <template #body="row">
                <ElPrice :currency="row.data.currency" :value="row.data.client_rent_amount"/>
            </template>
        </Column>
        <Column :header="$t('column.status')">
            <template #body="row">
                <ElText :value="row.data.status_text"/>
            </template>
        </Column>
        <Column field="updated_at_text" :header="$t('column.updated_at')"/>
        <Column :header="$t('message.actions')">
            <template #body="row">
                <ElActionMenu>
                    <ElActionMenuEdit v-ability="Ability.M_BILL_EDIT" :href="route('dashboard.bill.edit',row.data.id)"/>
                    <ElActionMenuItem @click="rep_print_bill.print(row.data)"
                        :text="$t('message.print_bill')"/>
                    <ElActionMenuDeleteAction v-ability="Ability.M_BILL_DELETE"
                                              :dialog-message="'# '+row.data.id"
                                              :href="route('dashboard.bill.delete',row.data.id)"/>
                </ElActionMenu>
            </template>
        </Column>
    </ElDataTable>
    <BillPrint ref="rep_print_bill"/>
</template>

<style scoped>

</style>
