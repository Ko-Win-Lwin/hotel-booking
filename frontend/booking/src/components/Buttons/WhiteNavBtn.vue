<script setup>
import { onMounted } from "vue"


const props = defineProps({
    label: String,
})

</script>

<template>
    <button type="button"
        class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold shadow-xs bg-white text-gray-900 ring-1 ring-gray-300 ring-inset hover:bg-gray-50">

        {{ label }}
    </button>

    <!-- <button type="button"
        class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
        Book Now
    </button> -->
</template>
