<template>
    <div class="print:hidden text-right grid md:grid-cols-3 lg:grid-cols-4 gap-3 pt-2" v-bind="$attrs">
        <template v-for="(filterItem, key) in filters">
            <ElFloatingDropdown v-if="filterItem.type === 'dropdown' && filterItem.show && (filterItem?.data??[]).length"
                :form="filter" :name="key" option-label="name" :options="filterItem.data" class="grow max-w-[300px]"/>

            <ElFloatingMultiSelect v-if="filterItem?.type === 'multi_select' && filterItem.show && (filterItem?.data??[]).length"
                :form="filter" :name="key" option-label="name" :options="filterItem.data" class="grow max-w-[300px]"/>

            <ElFloatingDatePicker v-if="filterItem.type === 'date_range' && filterItem.show"
                                  selectionMode="range"
                :form="filter" :name="key" class="grow max-w-[300px]"/>
        </template>

        <slot/>
    </div>
</template>

<script setup>
import {useQuery} from "@/Helpers/useQuery";
import {ref, watch} from "vue";
import {router} from "@inertiajs/vue3";
import ElFloatingDropdown from "../Form/ElFloatingDropdown.vue";
import ElFloatingMultiSelect from "../Form/ElFloatingMultiSelect.vue";
import ElFloatingDatePicker from "../Form/ElFloatingDatePicker.vue";
import {Enum} from "@/enum";

const props = defineProps({
    filters: Object,
    autoReload: {type: Boolean, default: true},
});
const query = useQuery();
const filter = ref(initFilter(props.filters));

const emit = defineEmits(['filterChange']);

watch(filter, (data) => {
    let new_filter = {};
    for (const key in data) {
        if (data[key] != null && data[key] !== '') {
            new_filter[key] = data[key];
        }
    }
    console.log('new_filter :>> ', new_filter);
    if (props.autoReload) {
        router.get(window.location.pathname, new_filter, {
            preserveState: false,
            preserveScroll: true,
            replace: true,
        })
    }


}, {
    deep: true
})

function initFilter(filters) {

    let queryFilters = {};
    Object.entries(filters).forEach(entry => {
        if (entry[1].type === 'multi_select') {
            const key = entry[0]
            if (entry[1].isInt) {
                queryFilters[key] = query.getArrayInt(key);
            } else {
                queryFilters[key] = query.getArray(key);
                // queryFilters[key] = [query.getArray(key)][0] && Array.isArray([query.getArray(key)][0]) ? Array.from(query.getArray(key)) :
                //     (query.getArray(key) ? [query.getArray(key)] : query.getArray(key));
            }
        } else if (entry[1].type === 'date_range') {
            const key = entry[0];
            let date_range = [
                query.get(key + '[0]') ? new Date(query.get(key + '[0]')) : null,
                query.get(key + '[1]') ? new Date(query.get(key + '[1]')) : null
            ] ;
            date_range = date_range.filter(function (el) {
                return el != null;
            });
            queryFilters[key] = date_range.length ? date_range : null;
        }else {
            const [key, filter] = entry;
            queryFilters[key] = query.get(key, filter.isInt);
        }
    });
    return queryFilters;
}

</script>

<style>

</style>

