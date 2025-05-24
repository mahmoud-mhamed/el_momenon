<template>
    <ElContainer>
        <div class="flex justify-end mb-2">
            <ElSecondaryButton :href="route('dashboard.bill.create',{'select_supplier_id':props.data.row.id})"
                               v-ability="Ability.M_BILL_CREATE"
                               :text="$t('message.add_bill')"/>
        </div>
        <ElDataTable :src="props.data.bills">
            <Column :header="$t('column.id')">
                <template #body="row">
                    <ElRouteBillProfile :model="row.data"/>
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
            <Column :header="$t('column.profit')">
                <template #body="row">
                    <ElPrice :currency="row.data.currency" :value="row.data.profit"/>
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
    </ElContainer>

    <BillPrint ref="rep_print_bill"/>

</template>

<script setup>
import ElContainer from "@/Components/Card/ElContainer.vue";
import {usePage} from "@inertiajs/vue3";
import ElLabelValueText from "@/Components/Text/ElLabelValueText.vue";
import ElModelUpdatedAtValueText from "@/Components/Text/ElModelUpdatedAtValueText.vue";
import ElLabelImage from "@/Components/Text/ElLabelImage.vue";
import {Ability} from "@/ability.js";
import ElActionMenuEdit from "@/Components/ActionMenu/ElActionMenuEdit.vue";
import ElRouteBillProfile from "@/Components/ElRoutes/ElRouteBillProfile.vue";
import ElText from "@/Components/Text/ElText.vue";
import ElActionMenuDeleteAction from "@/Components/ActionMenu/ElActionMenuDeleteAction.vue";
import Column from "primevue/column";
import ElDataTable from "@/Components/Table/ElDataTable.vue";
import ElRouteClientProfile from "@/Components/ElRoutes/ElRouteClientProfile.vue";
import ElRouteSupplierProfile from "@/Components/ElRoutes/ElRouteSupplierProfile.vue";
import ElActionMenu from "@/Components/ActionMenu/ElActionMenu.vue";
import ElSecondaryButton from "@/Components/Buttons/ElSecondaryButton.vue";
import ElPrice from "@/Components/Text/ElPrice.vue";
import ElActionMenuItem from "@/Components/ActionMenu/ElActionMenuItem.vue";
import BillPrint from "@/Pages/Bill/BillPrint.vue";
import {ref} from "vue";

const props = defineProps(['data']);
const rep_print_bill = ref();
</script>
