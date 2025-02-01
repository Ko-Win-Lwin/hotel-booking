<script setup>
import { onMounted, reactive, ref } from "vue";
import axios from 'axios'

// import Datepicker from 'vue3-datepicker';
const rooms = ref([])

const booking = reactive({})

const user = localStorage.getItem('user')

onMounted(() => {
    axios.get('/rooms').then(response => rooms.value = response.data)
})

</script>

<template>
    <div class="grid grid-cols-3 gap-4">
        Hello {{ user ?? 'guest' }}
    </div>
</template>

