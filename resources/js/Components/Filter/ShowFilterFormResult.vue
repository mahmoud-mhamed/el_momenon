<template>
    <div class="print:hidden text-right flex flex-wrap filter-elements flex-grow gap-2 py-2" v-bind="$attrs">
        <section v-for="filterItem in queryFilters" :key="Math.random()+'filter'">
            <aside
                v-if="filterItem.type==='multi_select' || filterItem.type === 'dropdown' || filterItem.type === 'date_range' ">
                <div class="bg-primary-500 inline-block text-white p-2 rounded-md">
                    <label class="text-primary-700 cursor-pointer" @click="removeFilter(filterItem)">
                        <i class="pi pi-times"></i>
                    </label>
                    {{ filterItem.label }}
                    <span class="ms-2">|</span>
                    <label v-if="filterItem.type==='multi_select'" v-for="(nameToShow, index) in filterItem.name"
                           class="mx-2">
                        <span class="me-2" v-if="index!==Object.keys(filterItem.name).length-1">-</span>
                        {{ nameToShow }}
                    </label>
                    <label v-else-if="typeof(filterItem.el_values) =='object'"
                           v-for="(item,index) in filterItem.el_values"
                           class="mx-2">
                        <span class="me-2" v-if="index!==Object.keys(filterItem.el_values).length-1">-</span>
                        {{ item }}
                    </label>
                    <label v-else class="mx-2">{{ filterItem.name ?? filterItem.el_values }}</label>
                </div>
            </aside>
        </section>
    </div>
</template>

<script setup>
import {useQuery} from "@/Helpers/useQuery";
import {router, usePage} from "@inertiajs/vue3";
import {useI18n} from "vue-i18n";
import {ref, watch} from "vue";

const query = useQuery();
const {t} = useI18n()

const queryFilters = ref([]);
const renderFilterObject = () => {
    queryFilters.value = [];
    let shared_filters = usePage().props.filters;
    for (const argumentsKey in shared_filters) {
        let item = shared_filters[argumentsKey];
        if (item.type === 'multi_select') {
            let names = [];
            if (item.isInt) {
                let el_val = query.getArrayInt(argumentsKey);
                if (el_val?.length) {
                    item.data.forEach(itemt => {
                        if (el_val.includes(itemt.id)) {
                            names.push(itemt.name)
                        }
                    })
                    queryFilters.value.push({
                        'el_values': el_val,
                        'label': t('column.' + argumentsKey ?? argumentsKey),
                        'key': argumentsKey,
                        'type': item.type,
                        'name': names
                    });
                }
            } else {
                let el_val = query.getArray(argumentsKey);
                item.data.forEach(itemt => {
                    if (el_val.includes(String(itemt.id))) {
                        names.push(itemt.name)
                    }
                })
                if (el_val.length)
                    queryFilters.value.push({
                        'el_values': el_val,
                        'label': t('column.' + argumentsKey ?? argumentsKey),
                        'key': argumentsKey,
                        'type': item.type,
                        'name': names
                    });
            }

            continue;
        }

        if (item.type === 'date_range') {
            let date_range = [
                query.get(argumentsKey + '[0]') ? formatDate(query.get(argumentsKey + '[0]')) : null,
                query.get(argumentsKey + '[1]') ? formatDate(query.get(argumentsKey + '[1]')) : null
            ];
            date_range = date_range.filter(function (el) {
                return el != null;
            });

            if (date_range.length)
                queryFilters.value.push({
                    'el_values': date_range.length ? date_range.join(' - ') : null,
                    'label': t('column.' + argumentsKey ?? argumentsKey),
                    'key': argumentsKey,
                    'type': item.type
                });

            continue;
        }

        if (item.type === 'dropdown') {
            // const [argumentsKey, filter] = item;
            const filter = item;
            if (query.get(argumentsKey, filter.isInt))
                queryFilters.value.push({
                    'el_values': query.get(argumentsKey, filter.isInt),
                    'label': t('column.' + argumentsKey ?? argumentsKey),
                    'key': argumentsKey,
                    'type': item.type,
                    'name': Array.from(filter.data).find(dataum => dataum.id == query.get(argumentsKey, filter.isInt))?.name
                });


        }
        // console.log('object :>> ', queryFilters.value);
    }
}

function formatDate(dateValue) {
    let date = new Date(dateValue);
    const offset = date.getTimezoneOffset()
    date = new Date(date.getTime() - (offset * 60 * 1000))
    return date.toISOString().split('T')[0]
}

renderFilterObject();
watch(() => usePage().props.filters, function (val) {
    renderFilterObject();
}, {
    immediate: true,
    deep: true,
});

const removeFilter = (filter_item) => {
    const queryParams = new URLSearchParams(window.location.search);
    if (filter_item.type === 'multi_select') {
        let arr = filter_item.el_values;
        arr.forEach((element, i) => {
            queryParams.delete(filter_item.key + `[${i}]`);
        });
    } else if (filter_item.type === 'date_range') {
        queryParams.delete(filter_item.key + '[0]');
        queryParams.delete(filter_item.key + '[1]');
    } else {
        queryParams.delete(filter_item.key);
    }
    const newUrl = window.location.pathname + '?' + queryParams.toString();
    history.replaceState(null, '', newUrl);

    router.get(window.location.href, {}, {
        preserveState: false,
        preserveScroll: true,
        replace: true,
    });
    renderFilterObject();
}
</script>

<style>
.filter-elements .p-dropdown-clear-icon {
    margin-right: 0px !important;
}
</style>

