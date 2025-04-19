<template>
    <form @submit.prevent="submit()">
        <div class="grid md:grid-cols-2 mt-2 gap-3">
            <el-floating-input :form="el_form" name="title" required/>
            <el-floating-price-eg :form="el_form" name="amount" required/>
            <el-floating-date-picker :form="el_form" name="operation_date" required/>
            <el-floating-input :form="el_form" name="note"/>
        </div>

        <div class="flex flex-row-reverse gap-2 mt-3">
            <el-secondary-button :text="$t('message.cancel')" @click="emit('hide')" v-if="is_create"/>
            <el-submit-button :text="$t('message.save')" :form="el_form"/>
        </div>
    </form>
</template>

<script setup>
import {useForm} from "@inertiajs/vue3";
import ElFloatingInput from "@/Components/Form/ElFloatingInput.vue";
import ElSubmitButton from "@/Components/Buttons/ElSubmitButton.vue";
import ElSecondaryButton from "@/Components/Buttons/ElSecondaryButton.vue";
import ElFloatingPriceEg from "@/Components/Form/ElFloatingPriceEg.vue";
import ElFloatingDropdown from "@/Components/Form/ElFloatingDropdown.vue";
import {watch} from "vue";
import collect from "collect.js";
import ElFloatingDatePicker from "@/Components/Form/ElFloatingDatePicker.vue";

const emit = defineEmits(['hide']);

const props = defineProps({
    row: {
        type: Array,
        default: {}
    },
    form_data: {
        type: Object,
        default: null,
    }
})
const is_create = !props?.row?.id;
const el_row = props?.row;
const el_form = useForm({
    id: el_row?.id,
    title: el_row?.title,
    amount: el_row?.amount,
    operation_date: el_row?.operation_date,
    note: el_row?.note,
})
const submit = () => {
    el_form.post(is_create ? route('dashboard.expense.store') : route('dashboard.expense.update', el_form.id), {
        preserveState: true,
        onSuccess: () => {
            is_create && el_form.reset();
        },
    })
}
const setEmplyeeAmount = () => {
    if (el_form.id) {
        return;
    }
    if (el_form.type!=='salary')
        return;
    if (!el_form.employee_id)
        return;

    el_form.amount = collect(props.form_data.employees).where('id', el_form.employee_id).first().salary;
}
watch(() => el_form.employee_id, setEmplyeeAmount, {deep: true});
watch(() => el_form.type, setEmplyeeAmount, {deep: true});

</script>
