<template>
    <form @submit.prevent="submit()">
        <div class="grid md:grid-cols-2 mt-2 gap-3">
            <el-floating-date-picker :form="el_form" required name="date"/>
            <el-floating-dropdown :form="el_form" required name="type" :options="formData.types"/>
            <el-floating-price :form="el_form" required name="currency_amount"/>
            <el-floating-dropdown :form="el_form" required name="currency_id" :options="formData.currencies"/>
            <el-floating-price-eg :form="el_form" required name="eg_currency_amount"/>
            <el-floating-input :form="el_form" required name="statement"/>
            <el-floating-input :form="el_form" v-if="el_form.type===Enum.NotebookTypeEnum.SENDER"
                               required name="sender"/>
            <el-floating-input :form="el_form" v-if="el_form.type==Enum.NotebookTypeEnum.RECEIVER"
                               required name="recipient"/>
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
import ElFloatingPassword from "@/Components/Form/ElFloatingPassword.vue";
import ElFloatingDropdown from "@/Components/Form/ElFloatingDropdown.vue";
import ElAvatarInput from "@/Components/Form/ElAvatarInput.vue";
import ElSecondaryButton from "@/Components/Buttons/ElSecondaryButton.vue";
import ElFloatingPrice from "@/Components/Form/ElFloatingPrice.vue";
import ElFloatingDatePicker from "@/Components/Form/ElFloatingDatePicker.vue";
import ElFloatingPriceEg from "@/Components/Form/ElFloatingPriceEg.vue";
import {Enum} from "@/enum.js";

const emit = defineEmits(['hide']);

const props = defineProps({
    row: {
        type: Array,
        default: {}
    },
    formData: {
        type: Object,
        default: null,
    }
})
const is_create = !props?.row?.id;
const el_row = props?.row;
const el_form = useForm({
    id: el_row?.id,
    date: el_row?.date,
    type: el_row?.type,
    currency_id: el_row?.currency_id,
    currency_amount: el_row?.currency_amount,
    eg_currency_amount: el_row?.eg_currency_amount,
    statement: el_row?.statement,
    sender: el_row?.sender,
    recipient: el_row?.recipient,
})
const submit = () => {
    el_form.post(is_create ? route('dashboard.notebook.store') : route('dashboard.notebook.update', el_form.id), {
        preserveState: true,
        onSuccess: () => {
            is_create && el_form.reset();
        },
    })
}

</script>
