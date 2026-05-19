<template>
    <aside class="floating-editor">
        <label class="block mb-1 text-sm text-gray-500">
            {{ label ?? $t('column.' + name) }}
            <ElTextRequired v-if="required"/>
        </label>
        <Editor v-model="form[name]" :editorStyle="editorStyle" :disabled="processing || form.processing"
                @load="({ instance }) => { instance.format('direction', 'rtl'); instance.format('align', 'right'); }"/>
        <ElTextError v-if="hasError()" :value="form['errors'][name]"/>
    </aside>
</template>

<script setup>
import Editor from 'primevue/editor';
import ElTextError from "@/Components/Text/ElTextError.vue";
import ElTextRequired from "@/Components/Text/ElTextRequired.vue";

const props = defineProps({
    label: String,
    name: String,
    form: Object,
    editorStyle: {type: String, default: 'height: 200px'},
    required: {type: Boolean, default: false},
    processing: {type: Boolean, default: false},
});
const hasError = () => props.form && (props.form['errors'] ?? false) ? props.form['errors'][props.name] : false;
</script>

<style scoped>
:deep(.ql-editor) {
    direction: rtl;
    text-align: right;
}
</style>
