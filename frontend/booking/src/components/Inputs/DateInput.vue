<script setup>
import Datepicker from 'vue3-datepicker';

import { ref, watch } from 'vue';


const emit = defineEmits(['update:modelValue'])

const props = defineProps({
    modelValue: {
        type: Date,
        default: () => new Date()
    },

    label: String
})

const picked = ref(new Date())


watch(picked, (newDate) => {
    const formattedDate = newDate.toISOString().split('T')[0];
    emit('update:modelValue', formattedDate);
})
</script>

<template>
    <div class="flex justify-between gap-4 items-center px-4 py-2 mt-4 bg-gray-400 rounded">
        <span>{{ label }}</span>
        <Datepicker v-model="picked" class="bg-gray-400 w-24" />
    </div>
</template>