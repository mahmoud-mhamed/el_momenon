<template>
    <form @submit.prevent="submit">
        <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
            <ElCardWithTitle :title="$t('message.purchase_data')">
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
                    <ElFloatingDropdown :form="el_form" name="supplier_id" required :options="form_data.suppliers"/>
                    <ElFloatingInput :form="el_form" name="car_type" required/>
                    <ElFloatingInput :form="el_form" name="chassis_number" required/>
                    <ElFloatingDatePicker :form="el_form" name="purchase_date" required/>
                    <ElFloatingDropdown :form="el_form" name="purchase_type" :options="form_data.purchase_types"/>

                    <hr class="col-span-full"/>
                    <ElFloatingDropdown :form="el_form" name="shipping_type"/>
                    <ElFloatingDatePicker :form="el_form" name="shipping_date"/>
                    <ElFloatingPrice :form="el_form" name="shipping_amount"/>
                    <ElFloatingInput :form="el_form" name="policy_number"/>

                    <hr class="col-span-full"/>
                    <ElFloatingPrice :form="el_form" name="purchase_price"/>
                </div>
            </ElCardWithTitle>
            <ElCardWithTitle :title="$t('message.selling_data')">
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
                    <ElFloatingDropdown :form="el_form" name="client_id" required :options="form_data.clients"/>
                    <ElFloatingDropdown :form="el_form" name="disabled_client_id"  :options="form_data.clients"/>
                    <hr class="col-span-full"/>
                    <ElFloatingPrice :form="el_form" name="selling_price"/>
                    <hr class="col-span-full"/>
                    <ElFloatingTextarea :form="el_form" name="notes"/>
                </div>
            </ElCardWithTitle>

            <div class="text-end col-span-full gap-4 w-full mt-4">
                <ElSubmitButton :text="$t('message.save')" :form="el_form"/>
            </div>
        </div>
    </form>
</template>

<script setup>
import {useForm} from "@inertiajs/vue3";
import ElSubmitButton from "@/Components/Buttons/ElSubmitButton.vue";
import ElCardWithTitle from "@/Components/Card/ElCardWithTitle.vue";
import ElFloatingDropdown from "@/Components/Form/ElFloatingDropdown.vue";
import ElFloatingPrice from "@/Components/Form/ElFloatingPrice.vue";
import ElFloatingDatePicker from "@/Components/Form/ElFloatingDatePicker.vue";
import ElFloatingInput from "@/Components/Form/ElFloatingInput.vue";
import ElFloatingTextarea from "@/Components/Form/ElFloatingTextarea.vue";

const props = defineProps({
    form_data: Object,
    row: Object,
});
const is_create = !props?.row?.id;

const el_form = useForm({
    id: props.role?.id ?? null,
    title: props.role?.title ?? null,
    abilities: props.current_abilities ?? [],
});


const submit = () => {
    el_form.post(el_form.id ? route('dashboard.bill.update', el_form.id) : route('dashboard.bill.store'), {
        preserveState: true,
        onSuccess: () => {
            is_create && el_form.reset();
        },
    })
};
</script>
