<script setup>
import axios from 'axios'
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import Button from '../components/Buttons/Button.vue'
import UserInput from '../components/Inputs/UserInput.vue'

const router = useRouter()

const email = ref('')
const password = ref('')

const login = async () => {

    try {
        const response = await axios.post('/login', {
            email: email.value,
            password: password.value
        }, {
            headers: {
                'Content-Type': "application/json"
            }
        })

        console.log('login successful.', response.data)

        localStorage.setItem('user', response.data.user.id)
        router.push('/booking')

    } catch (error) {
        console.error("Login Failed.", error.response ? error.response.data : error.message)
    }
}

</script>

<template>
    <div class="max-w-80 mx-auto shadow-sm mt-8">
        <div class="border rounded py-4 ">
            <h1 class="text-center text-3xl font-bold text-blue-500">Login</h1>
            <div class="px-2 text-white font-bold">
                <div class="mt-4">
                    <UserInput v-model="email" type="email" label="Email" placeholder="example@gmail.com">
                    </UserInput>
                </div>

                <div class="mt-4">
                    <UserInput v-model="password" type="password" label="Password"></UserInput>
                </div>

                <div class="mt-4">
                    <Button :classes="['bg-blue-500', 'w-full']" label="Login" @click="login"></Button>
                </div>
            </div>

        </div>
    </div>
</template>
