<script setup>
const emit = defineEmits(['update:modelValue'])
const props = defineProps({
    modelValue: {
        type: String,
        default: ''
    },

    type: String,
    label: String,
    placeholder: {
        type: String,
        default: ''
    }
})
</script>

<template>
    <div
        class="rounded-md bg-white outline-1 -outline-offset-1 outline-gray-300 has-[input:focus-within]:outline-2 has-[input:focus-within]:-outline-offset-2 has-[input:focus-within]:outline-indigo-600">
        <div class="shrink-0 text-base text-blue-500 select-none sm:text-sm/6">{{ label }}</div>
        <input :type="type" name="" id=""
            class="block min-w-0 w-full grow py-1.5 px-1 text-base border text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
            :placeholder="placeholder" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)">
    </div>
</template>