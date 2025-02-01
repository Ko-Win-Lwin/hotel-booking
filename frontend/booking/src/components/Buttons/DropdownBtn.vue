<script setup>
import { ref, watch } from 'vue'
import { RouterLink, useRoute } from 'vue-router'
import DropdownLink from '../Links/DropdownLink.vue'

const props = defineProps({
    label: String
})

const route = useRoute()
const show = ref(false)

const toggleDropdown = () => {
    show.value = !show.value
}

watch(route, () => {
    show.value = false
})
</script>

<template>
    <div class="relative ml-3 sm:hidden">
        <button type="button" @click="toggleDropdown"
            class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 shadow-xs ring-gray-300 ring-inset hover:ring-gray-400"
            id="mobile-menu-button" aria-expanded="false" aria-haspopup="true">
            {{ label }}
            <svg class="-mr-1 ml-1.5 size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"
                data-slot="icon">
                <path fill-rule="evenodd"
                    d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                    clip-rule="evenodd" />
            </svg>
        </button>

        <!--

        Entering: "transition ease-out duration-200"
          From: "transform opacity-0 scale-95"
          To: "transform opacity-100 scale-100"
        Leaving: "transition ease-in duration-75"
          From: "transform opacity-100 scale-100"
          To: "transform opacity-0 scale-95"
      -->
        <div v-if="show"
            class="absolute right-0 z-10 mt-2 -mr-1 w-48 origin-top-right rounded-md bg-white py-1 ring-1 shadow-lg ring-black/5 focus:outline-hidden"
            role="menu" aria-orientation="vertical" aria-labelledby="mobile-menu-button" tabindex="-1">
            <slot></slot>
        </div>
    </div>
</template>