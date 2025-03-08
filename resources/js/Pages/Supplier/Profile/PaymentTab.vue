<template>
    <ElContainer>
        <ElDataTable :src="props.data.payments">
            <Column :header="$t('column.bill_id')">
                <template #body="row">
                    <ElRouteBillProfile :model="row.data.bill"/>
                </template>
            </Column>
            <Column :header="$t('column.payment_date')">
                <template #body="row">
                    <ElText :value="row.data.payment_date"/>
                </template>
            </Column>
            <Column :header="$t('column.paid_amount') + ' - '+$t('column.paid_currency_id')">
                <template #body="row">
                    <ElPrice :value="row.data.paid_amount" :currency="row.data.paid_currency"/>
                </template>
            </Column>
            <Column :header="$t('column.bill_currency_equal_value')">
                <template #body="row">
                    <ElPrice :currency="row.data.bill.currency" :value="1"/>
                    =
                    <ElPrice :value="row.data.bill_currency_equal_value" :currency="row.data.paid_currency"/>
                </template>
            </Column>
            <Column :header="$t('column.paid_amount')">
                <template #body="row">
                    <ElPrice :value="row.data.bill_currency_equal_total" :currency="row.data.bill.currency"/>
                </template>
            </Column>
            <Column :header="$t('column.note')">
                <template #body="row">
                    <ElText :value="row.data.note"/>
                </template>
            </Column>
            <Column :header="$t('column.proof_archive_id')">
                <template #body="row">
                    <ArchiveCard v-if="row.data.proof_archive" :archive="row.data.proof_archive"/>
                    <ElText v-else/>
                </template>
            </Column>
            <Column field="created_at_text" :header="$t('column.created_at')"/>
        </ElDataTable>
    </ElContainer>
</template>

<script setup>
import ElContainer from "@/Components/Card/ElContainer.vue";
import ElActionMenu from "@/Components/ActionMenu/ElActionMenu.vue";
import ElDataTable from "@/Components/Table/ElDataTable.vue";
import ElActionMenuDeleteAction from "@/Components/ActionMenu/ElActionMenuDeleteAction.vue";
import Column from "primevue/column";
import ElPrice from "@/Components/Text/ElPrice.vue";
import ArchiveCard from "@/Components/Archive/ArchiveCard.vue";
import ElPrimaryButton from "@/Components/Buttons/ElPrimaryButton.vue";
import {ref} from "vue";
import ElActionMenuEdit from "@/Components/ActionMenu/ElActionMenuEdit.vue";
import Dialog from "primevue/dialog";
import BillPaymentFormCreateUpdate from "@/Pages/Bill/Profile/BillPaymentFormCreateUpdate.vue";
import ElRouteBillProfile from "@/Components/ElRoutes/ElRouteBillProfile.vue";

const props = defineProps(['data']);
</script>
