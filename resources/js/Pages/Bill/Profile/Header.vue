<template>
    <ElHeader>
        <template #header>
            <div class="flex flex-col gap-2">
                <ElLabelValueText :value="usePage().props?.profile_row.id" :label="$t('column.id')"/>
                <ElLabelValueText :value="usePage().props?.profile_row.chassis_number"
                                  :label="$t('column.chassis_number')"/>
                <ElLabelValueText :value="usePage().props?.profile_row.status_text" :label="$t('column.status')"/>
                <div class="flex gap-2">
                    <label>{{ $t('column.supplier_id') }} : </label>
                    <ElRouteSupplierProfile :model="usePage().props?.profile_row.supplier"/>
                </div>
                <div class="flex gap-2">
                    <label>{{ $t('column.client_id') }} : </label>
                    <ElRouteClientProfile :model="usePage().props?.profile_row.client"/>
                </div>
                <div class="flex flex-wrap gap-4">
                    <ElLabelValuePrice :value="usePage().props?.profile_row.purchase_price"
                                       class="w-[200px]"
                                       :currency="usePage().props?.profile_row.currency"
                                       :label="$t('column.purchase_price')"/>

                    <ElLabelValuePrice :value="usePage().props?.profile_row.supplier_paid_amount"
                                       class="w-[200px]"
                                       :currency="usePage().props?.profile_row.currency"
                                       :label="$t('column.supplier_paid_amount')"/>

                    <ElLabelValuePrice :value="usePage().props?.profile_row.supplier_rent_amount"
                                       class="w-[200px]"
                                       :currency="usePage().props?.profile_row.currency"
                                       :label="$t('message.supplier_rent')"/>
                </div>
                <div class="flex flex-wrap gap-4">
                    <ElLabelValuePrice :value="usePage().props?.profile_row.selling_price"
                                       :currency="usePage().props?.profile_row.currency"
                                       class="w-[200px]"
                                       :label="$t('column.selling_price')"/>
                    <ElLabelValuePrice :value="usePage().props?.profile_row.client_paid_amount"
                                       :currency="usePage().props?.profile_row.currency"
                                       class="w-[200px]"
                                       :label="$t('column.client_paid_amount')"/>

                    <ElLabelValuePrice :value="usePage().props?.profile_row.client_rent_amount"
                                       class="w-[200px]"
                                       :currency="usePage().props?.profile_row.currency"
                                       :label="$t('message.client_rent')"/>
                </div>
            </div>
        </template>
        <template #tabs>
            <Tabs :label="$t('message.main_data')" v-ability="Ability.M_BILL_PROFILE"
                  :href="route('dashboard.bill.profile.main_data',usePage().props?.profile_row.id)"/>
            <Tabs :label="$t('message.archive')" v-ability="Ability.M_BILL_ARCHIVE"
                  :href="route('dashboard.bill.profile.view-archive',usePage().props?.profile_row.id)"/>

            <Tabs :label="$t('message.supplier_bill_payment')" v-ability="Ability.M_BILL_VIEW_PAYMENT_SUPPLIER"
                  :href="route('dashboard.bill.profile.view-payment',{'bill':usePage().props?.profile_row.id,'type':'to_supplier'})"/>

            <Tabs :label="$t('message.client_bill_payment')" v-ability="Ability.M_BILL_VIEW_PAYMENT_CLIENT"
                  :href="route('dashboard.bill.profile.view-payment',{'bill':usePage().props?.profile_row.id,'type':'from_client'})"/>
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
import ElRouteSupplierProfile from "@/Components/ElRoutes/ElRouteSupplierProfile.vue";
import ElRouteClientProfile from "@/Components/ElRoutes/ElRouteClientProfile.vue";

</script>
