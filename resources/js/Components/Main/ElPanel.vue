<template>
    <main class="p-4 dark:bg-dark-500">
        <header class="flex justify-between">
            <div>
                <div class="flex gap-2">
                    <ElBreadcrumb class="dark:text-white" v-if="showBreadcrumb"/>
                </div>
            </div>
            <div>
                <div class="flex gap-2">
                    <slot name="actions"/>
                </div>
            </div>
        </header>
        <div >
            <div >
                <ShowFilterFormResult v-if="showFilters"/>
                <!-- <FilterForm :filters="$page.props.filters"/> -->
            </div>
            <slot/>
        </div>
    </main>
</template>

<script setup>
import ElBreadcrumb from "@/Components/Main/ElBreadcrumb.vue";
import ShowFilterFormResult from "@/Components/Filter/ShowFilterFormResult.vue";
const props = defineProps({
    showBreadcrumb: {
        type: Boolean,
        default: true
    },
    showFilters: {
        type: Boolean,
        default: true
    },
})

</script>


<style scoped>

</style>
