<template>

    <aside>

        <FloatLabel>

            <InputNumber
                :disabled="processing || form.processing"
                v-if="form && name"
                :class="{'p-invalid':hasError()}"
                v-model="form[name]"
                mode="decimal"
                :suffix="' ' + $t('message.sar')"
                fluid
                showButtons
                buttonLayout="horizontal"
                v-bind="$attrs"
            />

            <InputNumber
                v-else
                :value="modelValue"
                @input="updateValue"
                :class="{'p-invalid':hasError()}"
                inputId="currency-us"
                mode="currency"
                currency="SAR"
                locale="en-US"
                fluid
            />

            <label>
                {{ label ?? $t('column.' + name) }}
                <SpanRequired v-if="required"/>
            </label>

        </FloatLabel>

        <ElTextError
            v-if="hasError()"
            :value="customError??form['errors'][name]"
        />

    </aside>

</template>

<script setup>

import FloatLabel from 'primevue/floatlabel';
import InputNumber from 'primevue/inputnumber';
import ElTextRequired from "@/Components/Text/ElTextRequired.vue";
import ElTextError from "@/Components/Text/ElTextError.vue";
import SpanRequired from "@/Components/Form/ElSpanRequired.vue";

const props = defineProps({
    label: String,
    name: String,
    form: Object,
    required: {
        type: Boolean,
        default: false
    },
    modelValue: {
        type: String,
        default: null
    },
    customError: {
        type: Object,
        default: null,
    },
    processing: {
        type: Boolean,
        default: false
    },
})

const hasError = () => props.form && (props.form['errors'] ?? false) ? props.form['errors'][props.name] : !!props.customError;

const emit = defineEmits(['update:modelValue'])

const updateValue = (event) => {
    emit('update:modelValue', event.target.value)
}

</script>
