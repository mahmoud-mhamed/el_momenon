<template>
    <main class="mb-3" :key="'el_profile_key'+(usePage().props?.other_data?.refresh_dom_key??'')">
        <section v-if="$slots.header" class="mb-3">
            <slot name="header"/>
        </section>
        <section v-if="$slots.tabContent" :class="{'el-container':!$page.props.isTransparent}">
            <slot name="tabContent"></slot>
        </section>
    </main>
</template>

<script setup>

import {usePage} from "@inertiajs/vue3";
</script>

<style scoped>

</style>
