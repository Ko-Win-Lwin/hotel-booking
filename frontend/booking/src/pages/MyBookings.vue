<script setup>
import { onMounted, ref } from "vue";
import useMyBookings from "../store/mybookings";
import Button from "../components/Buttons/Button.vue";
import axios from "axios";
import { watch } from "vue";
import { useRoute, useRouter } from "vue-router";

const bookings = ref([])
const route = useRoute()

watch(bookings, async () => {
    await getBooking(); 
})

const getBooking = async () => {
    try {
        bookings.value = await useMyBookings();  // Update the ref with fetched bookings
    } catch (e) {
        console.error("Couldn't load booking data.", e);
    }
}

const cancelBooking = async (booking) => {
    const user_id = localStorage.getItem('user')
    try {
        const response = await axios.delete(`/bookings/${booking.id}`, {
        headers: {
            "Authorization": `Bearer ${user_id}`,
            "Content-Type": "application/json"
        }
    })
        console.log(response.data.message)

    
    } catch (error) {
        console.error(error.response ? error.response.data : error.message  )
    }
}

onMounted(async () => {
    await getBooking();  // Fetch bookings when the component is mounted
});

</script>

<template>
    <div class="max-w-80 mx-auto border rounded py-4 shadow-sm mt-8">
            <h1 class="text-center text-3xl font-bold text-blue-500">My Bookings</h1>
            <div class="px-2 font-bold mt-4 space-y-4">
                <div v-for="booking in bookings" class="border rounded p-4" :key="booking.id">
                    <p>Check In - {{  booking.check_in_date }}</p>
                    <p>Check Out - {{  booking.check_out_date }}</p>
                    <p>Status - {{  booking.status }}</p>
                    <Button label="cancel" :class="['bg-blue-500', 'text-xs']" @click="cancelBooking(booking)"></Button>

                </div>
            </div>
        </div>
</template>