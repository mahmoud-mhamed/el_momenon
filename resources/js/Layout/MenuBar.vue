<template>

    <Menubar
        :model="$page.props.menu"
        class="!pb-0 el-menubar"
        :pt="{
            submenu: '!z-[99999]',
        }">
        <template #start>

            <div class="block md:hidden">
                <Sidebar v-model:visible="showMasterLayoutAsideBar" class="!w-[180px]">
                    <template #container="{ closeCallback }">
                        <MasterLayoutAsideBar/>
                    </template>
                </Sidebar>
                <Button class="-mt-4 me-1 !p-2.5" icon="pi pi-bars" @click="showMasterLayoutAsideBar = true"/>
            </div>

            <ElSearchInput v-if="$page.props.allowSearch"/>
        </template>
        <template #item="{ item, props, hasSubmenu, root }">
        </template>

        <template #end>
            <div
                class="flex space-x-2 pb-2 space-x-reverse flex-shrink-0 justify-center items-center content-center leading-5 text-slate-900">
                <Popover ref="ref_popover" style="width: max-content" :breakpoints="{'960px': '75vw'}">
                    <UserMenu/>
                </Popover>
                <!--                <MasterLayoutNotifications/>-->
                <div
                    class="flex space-x-2 space-x-reverse items-center bg-gray-50 dark:bg-slate-500/20 py-1 px-1.5 rounded-lg cursor-pointer text-slate-900 dark:text-primary-100"
                    @click="togglePopover">
                    <img :src="$page.props.auth.user?.avatar_url" class="h-8 w-8 rounded-full"/>
                    <span v-text="$page.props.auth.user?.name"/>
                    <i class="pi pi-chevron-down" style="font-size: 1rem"></i>
                </div>
            </div>
        </template>

    </Menubar>

</template>

<script setup>

import {ref} from "vue";
import {Menubar} from "primevue";
import UserMenu from "@/Layout/Partial/UserMenu.vue";
import Popover from "primevue/popover";
import ElSearchInput from "@/Components/Form/ElSearchInput.vue";
import MasterLayoutAsideBar from "@/Layout/Partial/MasterLayoutAsideBar.vue";
import Button from 'primevue/button';
import Sidebar from 'primevue/sidebar';

const ref_popover = ref();
const togglePopover = (event) => {
    ref_popover.value.toggle(event);
}
const showMasterLayoutAsideBar = ref(false);
</script>
<style>
.el-menubar .p-menubar-button{
    display: none!important;
}
</style>
