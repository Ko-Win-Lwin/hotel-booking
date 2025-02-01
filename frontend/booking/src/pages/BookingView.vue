<script setup>
import DateInput from '../components/Inputs/DateInput.vue'
import Button from '../components/Buttons/Button.vue'
import { reactive, ref } from 'vue';
import axios from 'axios';

const availableRooms = ref([])

const booking = reactive({
    check_in_date: null,
    check_out_date: null,
    number_of_guests: 1,
})

const findRoom = async () => {
    try {
        const response = axios.get('/available-rooms', {
        params: {
            'check_in_date': booking.check_in_date,
            'check_out_date': booking.check_out_date,
            'number_of_guests': parseInt(booking.number_of_guests)
        },
        headers: {
            'Content-Type': "application/json"
            }

        })
        .then(response => availableRooms.value = response.data.rooms)
    } catch (error) {
        console.error(error.response ? error.response.data : error.message)
    }
     
}

const book = async (room) => {
    const user_id = localStorage.getItem('user')
    console.log(user_id)
    try {
        const response = await axios.post('/bookings', {
        room_id: room.id,
        check_in_date: booking.check_in_date,
        check_out_date: booking.check_out_date,
        number_of_guests: booking.number_of_guests
        }, {
            headers: {
                'Content-Type': "application/json",
                'Authorization': `Bearer ${user_id}`
            }
        }).then(response => console.log(response.data.message))
    } catch (error) {
        console.error("Booking Failed", error.response ? error.response.data : error.message);
    }
}
</script>

<template>
    <div class="">
        <div class="max-w-80 mx-auto border rounded py-4 shadow-sm">
            <h1 class="text-center text-3xl font-bold text-blue-500">Book Your Stay</h1>
            <div class="px-2 text-white font-bold">
                <!-- Check In -->
                <DateInput label="Check In" v-model="booking.check_in_date"></DateInput>

                <!-- Check out -->
                <DateInput label="Check Out" v-model="booking.check_out_date"></DateInput>

                <div class="flex justify-between gap-4 items-center px-4 py-2 mt-4 bg-gray-400 rounded">
                    <span>Guest</span>
                    <select v-model="booking.number_of_guests" class="bg-gray-400">
                        <option value=1 selected="selected" class="bg-gray-400">1</option>
                        <option value=2 class="bg-gray-400">2</option>
                        <option value=3 class="bg-gray-400">3</option>
                        <option value=4 class="bg-gray-400">4</option>
                        <option value=5 class="bg-gray-400">5</option>
                    </select>
                </div>

                <div class="mt-4">
                    <Button :classes="['bg-blue-500', 'w-full']" label="Book Now" @click="findRoom"></Button>
                </div>
            </div>

        </div>

        <div class="mt-8 w-full mx-auto px-4">
            <h1 class="text-center text-3xl font-bold text-blue-500">Available Rooms</h1>
            <div class="border-t my-4"></div>
            <div class="grid grid-cols-4 gap-4">
                <div v-for="room in availableRooms" class="border pb-2 text-gray-600 " :key="room.id">
                    <img :src="room.image" class="w-full h-56 mx-auto"/>
                    <div class="flex justify-between px-2"><span class="font-bold">Number</span>#{{ room.number }}</div>
                    <div class="flex justify-between px-2"><span class="font-bold">Type</span>{{ room.type }}</div>
                    <div class="flex justify-between px-2"><span class="font-bold">Capacity</span>{{ room.capacity }} person room</div>
                    <div class="flex justify-between px-2"><span class="font-bold">Price</span>{{ room.price }} MMK</div>
                    <div class="text-sm mt-4 text-gray-600 px-2">{{ room.description }}</div>
                    <div class="ml-2 mt-4">
                        <Button :classes="['bg-blue-500','text-xs']" label="Book Now" @click="book(room)"></Button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>