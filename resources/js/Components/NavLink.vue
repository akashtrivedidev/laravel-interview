<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});
</script>

<template>
    <Link
        :href="href"
        class="px-4 py-2 text-white border border-blue-300 rounded bg-blue-700 hover:bg-blue-800 focus:bg-blue-800"
    >
        <slot />
    </Link>
</template>
