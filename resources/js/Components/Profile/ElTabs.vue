<template>
    <li class="mr-2">
        <Link :href="href"
              :class="{'active border-primary_web-600 text-primary_web-600  hover:text-primary_web-600 bg-primary-400 text-white': is_active, 'border-transparent hover:border-primary_web-300': !is_active }"
              class="inline-block p-4 rounded-t-lg border-b-2 text-base">
            {{ label }}
        </Link>
    </li>
</template>

<script setup>

const props = defineProps({
    href: {type: String, default: null},
    label: String,
});

let is_active=props.href.endsWith(window.location.pathname.replace('/en',''));

</script>
