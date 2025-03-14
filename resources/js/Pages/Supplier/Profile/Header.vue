<template>
    <ElHeader>
        <template #header>
            <div class="flex flex-col gap-2">
                <ElLabelValueText :value="usePage().props?.profile_row.name" :label="$t('column.name')"/>
                <ElLabelValuePrice :currency="usePage().props?.profile_row.currency" :value="usePage().props?.profile_row.current_account" :label="$t('column.current_account')"/>
                <ElLabelValueText :value="usePage().props?.profile_row.bills_count" :label="$t('message.bills_count')"/>

            </div>
        </template>
        <template #tabs>
            <Tabs :label="$t('message.bills')" v-ability="Ability.M_SUPPLIER_BILLS"
                  :href="route('dashboard.supplier.profile.view-bills',usePage().props?.profile_row.id)"/>
            <Tabs :label="$t('message.payments')" v-ability="Ability.M_SUPPLIER_BILL_PAYMENTS"
                  :href="route('dashboard.supplier.profile.view-payment',usePage().props?.profile_row.id)"/>
        </template>
    </ElHeader>
</template>
<script setup>
import ElHeader from "@/Components/Profile/ElHeader.vue";
import Tabs from "@/Components/Profile/ElTabs.vue";
import {usePage} from "@inertiajs/vue3";
import {Ability} from "@/ability.js";
import AvatarProfile from "@/Components/Avatar/AvatarProfile.vue";
import ElText from "@/Components/Text/ElText.vue";
import ElLabelValueText from "@/Components/Text/ElLabelValueText.vue";
import ElLabelValuePrice from "@/Components/Text/ElLabelValuePrice.vue";

</script>
