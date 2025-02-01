<script setup>
import { onMounted } from "vue"


const props = defineProps({
    label: String,
    path: String
})

</script>

<template>
    <RouterLink :to="path" active-class="bg-gray-100 outline-hidden" class="block px-4 py-2 text-sm text-gray-700"
        role="menuitem" tabindex="-1" id="mobile-menu-item-0">
        {{ label }}
    </RouterLink>
</template>