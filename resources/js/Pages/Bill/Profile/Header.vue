<template>
    <ElHeader>
        <template #header>
            <div class="flex flex-col gap-2">
                <ElLabelValueText :value="usePage().props?.profile_row.id" :label="$t('column.id')"/>
                <ElLabelValueText :value="usePage().props?.profile_row.chassis_number" :label="$t('column.chassis_number')"/>
                <ElLabelValueText :value="usePage().props?.profile_row.status_text" :label="$t('column.status')"/>
            </div>
        </template>
        <template #tabs>
            <Tabs :label="$t('message.main_data')" v-ability="Ability.M_BILL_PROFILE"
                  :href="route('dashboard.bill.profile.main_data',usePage().props?.profile_row.id)"/>
            <Tabs :label="$t('message.archive')" v-ability="Ability.M_BILL_ARCHIVE"
                  :href="route('dashboard.bill.profile.view-archive',usePage().props?.profile_row.id)"/>
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

</script>
