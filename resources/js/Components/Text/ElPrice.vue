<template>

    <label class="whitespace-nowrap">

        <span v-if="value && value!=0">

            {{ numberFormat(value) }}

            <sub v-if="subValue || true" class="text-sm font-normal">{{ $t('message.sar') }}</sub>

            <label v-else>{{ $t('message.sar') }}</label>

        </span>

        <ElText v-else/>

    </label>

</template>

<script setup>

const props = defineProps({
    value: [String, Number],
    subValue: {type: Boolean, default: true}
});

function numberFormat(number) {
    return new Intl.NumberFormat('en-SA').format(number);
}

</script>
