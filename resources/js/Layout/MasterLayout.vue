<template>

    <PageHead/>

    <div class="flex flex-col font-sans font-normal leading-5 box-border">
        <div class="flex w-full max-w-[100vw]">
            <MasterLayoutAsideBar/>
            <div class="flex-grow" style="width: calc(100vw - 150px);">
                <MenuBar/>
                <ScrollPanel class="px-2">
                    <slot/>
                </ScrollPanel>
            </div>
        </div>
    </div>

    <NotificationAlert/>

</template>

<script setup>

import ScrollPanel from "primevue/scrollpanel";
import NotificationAlert from "@/Layout/Partial/NotificationAlert.vue";
import PageHead from "@/Layout/Partial/PageHead.vue";
import MenuBar from "@/Layout/MenuBar.vue";
import MasterLayoutAsideBar from "@/Layout/Partial/MasterLayoutAsideBar.vue";
</script>
