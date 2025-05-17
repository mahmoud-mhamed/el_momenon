<template>
    <Dialog v-model:visible="showDialogCreateUpdate" :style="{width: '50rem'}"
            :header="el_form.id?$t('message.edit'):$t('message.add_new')"
            modal maximizable>
        <form @submit.prevent="submit()">
            <div v-if="!el_form?.id" class="my-3 grid md:grid-cols-2 items-center gap-3">
                <ElFloatingDropdown :form="el_form" v-if="showSelectBill"
                                    class="flex-grow" name="bill_id" :options="form_data.bills"/>

                <ElLabelValuePrice :label="$t('column.rent')"
                                   class="flex-grow" v-if="el_form.bill_id"
                                   :currency="selected_bill?.currency"
                                   :value="selected_bill?.[el_form.type==='to_supplier'?'supplier_rent_amount':'client_rent_amount']"/>
            </div>
            {{selected_bill}}
            <div class="grid md:grid-cols-2 mt-2 gap-3" v-if="selected_bill">
                <el-floating-dropdown :form="el_form" required name="paid_currency_id" :options="form_data.currencies"/>

                <el-floating-price :form="el_form" required name="paid_amount"
                                   :currency="selected_paid_currency"/>

                <ElFloatingDatePicker :form="el_form" required name="payment_date"/>

                <div v-if="el_form.paid_currency_id && el_form.paid_currency_id !== selected_bill?.currency?.id">
                    <el-floating-price :form="el_form" required name="bill_currency_equal_value"
                                       :label="1 + ' '+selected_bill.currency?.name + ' = ........ '+selected_paid_currency?.name "
                                       :currency="selected_paid_currency"/>

                    <div class="flex items-center">
                        <ElLabelValuePrice :label="$t('column.bill_currency_equal_total')"
                                           :currency="selected_bill?.currency"
                                           v-if="el_form.bill_currency_equal_value && el_form.paid_amount"
                                           :value="(el_form.paid_amount/el_form.bill_currency_equal_value).toFixed(4)"/>

                        <ElLabelValuePrice v-else :label="$t('column.bill_currency_equal_total')"
                                           :currency="selected_bill?.currency"/>

                    </div>
                </div>

                <ElArchiveInput :form="el_form" :old-image-preview="el_form.proof_archive_id_url"
                                name="proof_archive_id"/>
                <ElFloatingTextarea class="col-span-full mt-3" :form="el_form" name="note"/>

            </div>

            <div class="flex flex-row-reverse gap-2 mt-3">
                <el-secondary-button :text="$t('message.cancel')" @click="showDialogCreateUpdate=false"
                                     v-if="!el_form?.id"/>
                <el-submit-button :text="$t('message.save')" :form="el_form"/>
            </div>
        </form>
    </Dialog>

</template>

<script setup>
import {useForm} from "@inertiajs/vue3";
import ElSubmitButton from "@/Components/Buttons/ElSubmitButton.vue";
import ElFloatingDropdown from "@/Components/Form/ElFloatingDropdown.vue";
import ElSecondaryButton from "@/Components/Buttons/ElSecondaryButton.vue";
import ElFloatingPrice from "@/Components/Form/ElFloatingPrice.vue";
import {collect} from "collect.js";
import ElFloatingTextarea from "@/Components/Form/ElFloatingTextarea.vue";
import ElFloatingDatePicker from "@/Components/Form/ElFloatingDatePicker.vue";
import ElArchiveInput from "@/Components/Form/ElArchiveInput.vue";
import ElLabelValuePrice from "@/Components/Text/ElLabelValuePrice.vue";
import {ref, watch} from "vue";
import Dialog from "primevue/dialog";

const emit = defineEmits(['hide']);

const props = defineProps({
    form_data: {
        type: Object,
        default: null,
    },
})
const is_create = !props?.row?.id;
const el_form = useForm({
    id: null,
    bill_id: null,
    paid_amount: null,
    paid_currency_id: null,
    bill_currency_equal_value: null,
    bill_currency_equal_total: null,
    type: null,
    note: null,
    payment_date: null,
    proof_archive_id: null,
    proof_archive_id_url: null,
});
const selected_paid_currency = ref();
let collect_currencies = collect(props.form_data.currencies);
const selectPaidCurrency = () => {
    if (!el_form.paid_currency_id) {
        selected_paid_currency.value = null;
        el_form.bill_currency_equal_value = null;
        return;
    }
    selected_paid_currency.value = collect_currencies.where('id', el_form.paid_currency_id).first();
    if (el_form.paid_currency_id === selected_bill.value?.currency?.id) {
        el_form.bill_currency_equal_value = 1;
        return;
    }
}


const submit = () => {
    if (el_form.paid_amount && el_form.bill_currency_equal_value)
        el_form.bill_currency_equal_total = (el_form.paid_amount / el_form.bill_currency_equal_value).toFixed(4);
    el_form.post(!el_form?.id ? route('dashboard.bill-payment.store', el_form.bill_id) : route('dashboard.bill-payment.update', el_form.id), {
        preserveState: true,
        onSuccess: () => {
            !el_form.id && el_form.reset();
        },
    })
}
const showSelectBill = ref(false);
const showDialogCreateUpdate = ref(false);
const selected_bill = ref();

const setSelectedBill = () => {
    if (!el_form.bill_id) {
        selected_bill.value = null;
        return;
    }
    selected_bill.value = collect_bills.where('id', el_form.bill_id).first();
}

watch(() => el_form.bill_id, setSelectedBill, {deep: true});
watch(() => el_form.paid_currency_id, selectPaidCurrency, {deep: true});

const collect_bills = collect(props.form_data.bills);
const showDialog = (edit_payment = null, type = null, bill_id = null) => {
    showSelectBill.value = !bill_id;
    el_form.reset();
    if (edit_payment) {
        selected_bill.value = edit_payment?.bill;
    }else{
        selected_bill.value = null;
    }
    if (!edit_payment) {
        el_form.type = type;
        el_form.bill_id = bill_id;
    }

    if (edit_payment) {
        let el_form_keys = Object.keys(el_form)
        for (let i = 0; i < el_form_keys.length; i++) {
            if (el_form_keys?.[i] && edit_payment.hasOwnProperty(el_form_keys[i])) {
                el_form[el_form_keys[i]] = edit_payment[el_form_keys[i]] ?? null;
            }
        }

        el_form.proof_archive_id_url = edit_payment?.proof_archive?.file_url;
    }
    el_form.proof_archive_id = null;
    showDialogCreateUpdate.value = true;
}

defineExpose({
    showDialog
});
</script>
