<script setup>
import WhiteNavBtn from './Buttons/WhiteNavBtn.vue'
import NavBtn from './Buttons/NavBtn.vue'
import DropdownBtn from './Buttons/DropdownBtn.vue'
import DropdownBtnVue from './Buttons/DropdownBtn.vue'
import DropdownLink from './Links/DropdownLink.vue'
import { onMounted, ref, watch } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import useMyBookings from '../store/mybookings'

const route = useRoute()
const router = useRouter()

const user = ref('')

const bookings = ref([])
const getBooking = async () => {
    try {
        bookings.value = await useMyBookings();  // Update the ref with fetched bookings
    } catch (e) {
        console.error("Couldn't load booking data.", e);
    }
}

watch(route, () => {
    user.value = localStorage.getItem('user')
})

const logout = () => {
    localStorage.removeItem('user')
    router.push('/')
}

onMounted(async () => {
    await getBooking()
    console.log(bookings.value)
})

</script>

<template>
    <div class="flex items-center justify-between">

        <div class="min-w-0 flex-1 text-2xl font-bold">
            <RouterLink to="/">
                MY<span class="text-blue-500">Book</span>
            </RouterLink>
        </div>
        <div class="flex lg:mt-0 lg:ml-4">
            <div v-if="!user">
                <RouterLink to="/login" class="hidden sm:block">
                    <WhiteNavBtn label="Login"></WhiteNavBtn>
                </RouterLink>
            </div>

            <div v-if="!user">
                <RouterLink to="/signup" class="ml-3 hidden sm:block">
                    <WhiteNavBtn label="Sign up"></WhiteNavBtn>
                </RouterLink>
            </div>

            <RouterLink v-if="user" to="/my-bookings" class="sm:ml-3">
                <NavBtn label="My Bookings"
                    :class="['bg-indigo-600', 'text-white', 'hover:bg-indigo-500', 'focus-visible:outline-2', 'focus-visible:outline-offset-2', 'focus-visible:outline-indigo-600']">
                </NavBtn>
            </RouterLink>

            <div v-if="user">
                <WhiteNavBtn label="Logout" class="ml-3 hidden sm:block" @click="logout">
                </WhiteNavBtn>
            </div>


            <RouterLink v-if="!bookings.value" to="/booking" class="sm:ml-3">
                <NavBtn label="Book Now"
                    :class="['bg-indigo-600', 'text-white', 'hover:bg-indigo-500', 'focus-visible:outline-2', 'focus-visible:outline-offset-2', 'focus-visible:outline-indigo-600']">
                </NavBtn>
            </RouterLink>

            


            <!-- Dropdown -->
            <DropdownBtn label="More">
                <DropdownLink path="/login" label="Login"></DropdownLink>
                <DropdownLink path="/signup" label="Sign Up"></DropdownLink>
            </DropdownBtn>
        </div>
    </div>

</template>