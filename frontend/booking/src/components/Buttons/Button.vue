<script setup>
import { onMounted } from "vue"


const props = defineProps({
    label: String,
    classes: {
        type: [Array, String],
        default: ''
    }
})

</script>

<template>

    <button type="button" class=" rounded-md  px-3 py-2 text-sm font-semibold text-white shadow-xs" :class="classes">
        {{ label }}
    </button>
</template>
