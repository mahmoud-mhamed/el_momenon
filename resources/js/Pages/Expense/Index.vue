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
import ElActionMenuEdit from "@/Components/ActionMenu/ElActionMenuEdit.vue";
import ElRouteEmployeeProfile from "@/Components/ElRoutes/ElRouteEmployeeProfile.vue";
import ElEgPrice from "@/Components/Text/ElEgPrice.vue";
import SalaryFormCreateUpdate from "@/Pages/Salary/SalaryFormCreateUpdate.vue";

const props = defineProps({
    data: Object,
})
const showDialogCreateUpdate = ref(false);
const edit_row = ref();
</script>

<template>
    <ElPanel>
        <template #actions>
            <el-primary-button @click="edit_row=null;showDialogCreateUpdate=true" v-ability="Ability.M_SALARY_CREATE"
                               :text="$t('message.add_new')"/>
        </template>
        <ElDataTable :src="props.data.rows">
            <Column :header="$t('column.id')">
                <template #body="row">
                    #
                    <ElText :value="row.data?.id"/>
                    -
                    <ElText :value="row.data.type_text"/>
                </template>
            </Column>
            <Column :header="$t('column.month')">
                <template #body="row">
                    <ElText :value="row.data.month_year"/>
                </template>
            </Column>
            <Column :header="$t('column.employee_id')">
                <template #body="row">
                    <ElRouteEmployeeProfile :model="row.data?.employee"/>
                </template>
            </Column>

            <Column :header="$t('column.amount')">
                <template #body="row">
                    <ElEgPrice :value="row.data.amount"/>
                </template>
            </Column>
            <Column :header="$t('column.note')">
                <template #body="row">
                    <ElText :value="row.data.note"/>
                </template>
            </Column>
            <Column :header="$t('message.actions')">
                <template #body="row">
                    <ElActionMenu>
                        <ElActionMenuEdit v-ability="Ability.M_SALARY_EDIT"
                                          @click="edit_row=row.data;showDialogCreateUpdate=true"/>
                        <ElActionMenuDeleteAction v-ability="Ability.M_SALARY_DELETE"
                                                  :el-id="row.data.id"
                                                  :dialog-message="row.data.employee?.name+' - '+row.data.month_year+' - '+row.data.type_text"
                                                  :href="route('dashboard.salary.delete',row.data.id)"/>
                    </ElActionMenu>
                </template>
            </Column>
        </ElDataTable>
    </ElPanel>
    <Dialog v-model:visible="showDialogCreateUpdate" :style="{width: '50rem'}"
            :header="edit_row?$t('message.edit'):$t('message.add_new')"
            modal maximizable>
        <SalaryFormCreateUpdate :form_data="data.form_data" :row="edit_row" @hide="showDialogCreateUpdate=false"/>
    </Dialog>
</template>

<style scoped>

</style>
