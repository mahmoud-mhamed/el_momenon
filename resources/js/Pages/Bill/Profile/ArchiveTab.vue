<template>
    <div class="flex gap-2 flex-wrap" v-if="data.archives || data.archives.length">
        <ArchiveCard :archive="item" v-for="item in data.archives"/>
    </div>
</template>

<script setup>
import ElContainer from "@/Components/Card/ElContainer.vue";
import ArchiveCard from "@/Components/Archive/ArchiveCard.vue";
import ElCardWithTitle from "@/Components/Card/ElCardWithTitle.vue";
import ElRouteBillProfile from "@/Components/ElRoutes/ElRouteBillProfile.vue";

const props = defineProps(['data']);
</script>
