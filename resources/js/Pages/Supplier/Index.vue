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
import ElActionMenuExportExcel from "@/Components/ActionMenu/ElActionMenuExportExcel.vue";

const props = defineProps({
    data: Object,
})
const showDialogCreateUpdate = ref(false);
const edit_row = ref();
</script>

<template>
    <ElPanel>
        <template #actions>
            <el-primary-button @click="edit_row=null;showDialogCreateUpdate=true" v-ability="Ability.M_SUPPLIER_STORE"
                               :text="$t('message.add_new_supplier')"/>
            <ElActionMenu>
                <ElActionMenuExportExcel/>
            </ElActionMenu>
        </template>
        <ElDataTable :src="props.data.rows">
            <Column :header="$t('column.name')">
                <template #body="row">
                    <ElRouteSupplierProfile :model="row.data"/>
                </template>
            </Column>
            <Column :header="$t('column.sum_bills_amount')">
                <template #body="row">
                    <ElPrice :value="row.data.sum_bills_amount" :currency="row.data.currency"/>
                </template>
            </Column>
            <Column :header="$t('column.sum_paid')">
                <template #body="row">
                    <ElPrice :value="row.data.sum_paid" :currency="row.data.currency"/>
                </template>
            </Column>
            <Column :header="$t('column.current_account')">
                <template #body="row">
                    <ElPrice :value="row.data.current_account" :currency="row.data.currency"/>
                </template>
            </Column>
            <Column :header="$t('column.currency_id')">
                <template #body="row">
                    <ElText :value="row.data.currency?.name"/>
                </template>
            </Column>
            <Column :header="$t('column.phone')">
                <template #body="row">
                    <ElText :value="row.data.phone"/>
                </template>
            </Column>
            <Column :header="$t('column.country')">
                <template #body="row">
                    <ElText :value="row.data.country"/>
                </template>
            </Column>
            <Column :header="$t('message.bills_count')">
                <template #body="row">
                    <ElText :value="row.data.bills_count"/>
                </template>
            </Column>
            <Column field="updated_at_text" :header="$t('column.updated_at')"/>
            <Column :header="$t('message.actions')">
                <template #body="row">
                    <ElActionMenu>
                        <ElActionMenuEdit v-ability="Ability.M_SUPPLIER_EDIT"
                                          @click="edit_row=row.data;showDialogCreateUpdate=true"/>
                        <ElActionMenuDeleteAction v-ability="Ability.M_SUPPLIER_DELETE"
                                                  :dialog-message="row.data.name"
                                                  :href="route('dashboard.supplier.delete',row.data.id)"/>
                    </ElActionMenu>
                </template>
            </Column>
        </ElDataTable>
    </ElPanel>
    <Dialog v-model:visible="showDialogCreateUpdate" :style="{width: '50rem'}"
            :header="edit_row?$t('message.edit'):$t('message.add_new')"
            modal maximizable>
        <SupplierFormCreateUpdate :form_data="data.form_data" :row="edit_row" @hide="showDialogCreateUpdate=false"/>
    </Dialog>
</template>

<style scoped>

</style>
