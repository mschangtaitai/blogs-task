<template>
    <div class="mx-auto max-w-2xl text-center">
        <h2 class="text-4xl font-bold tracking-tight text-blue-900 sm:text-6xl">Blogs app</h2>
        <p class="mt-6 text-lg leading-8 text-white-600">Sign up the best blogs app!</p>
    </div>
    <Form @submit="login" class="rounded-xl px-20 py-10 sm:py-14 bg-gray-600">
        <div class="font-bold py-2">First Name</div>
        <Field v-model="first_name" id="first name" name="first name"
            class="block w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            placeholder="First name" type="string" />
        <div class="font-bold py-2">Last Name</div>
        <Field v-model="last_name" id="last name" name="last name"
            class="block w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            placeholder="Last name" type="string" />
        <div class="font-bold py-2">Username</div>
        <Field v-model="username" id="username" name="username"
            class="block w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            placeholder="Username" type="string" />
        <div class="font-bold py-2">Email</div>
        <Field v-model="email" id="email" name="email"
            class="block w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            placeholder="Email" type="mail" />
        <div class="font-bold py-2">Password</div>
        <Field v-model="password" id="password" name="password"
            class="block w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            placeholder="Password" type="password" />
        <div class="font-bold py-2">Confirm password</div>
        <Field v-model="confirm_password" id="confirm password" name="confirm password"
            class="block w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            placeholder="Confirm Password" type="password" />

        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-4 rounded">Sign up</button>


    </Form>

</template>
<script setup>
import { computed, onMounted, reactive, ref } from "vue";
import { useRouter } from "vue-router";
import { Form, Field } from 'vee-validate';

import useAxios from "@/composables/useAxios.js"

const axios = useAxios()
const router = useRouter()

const first_name = ref(null)
const last_name = ref(null)
const username = ref(null)
const email = ref(null)
const password = ref(null)
const confirm_password = ref(null)

async function login() {
    await axios.get("sanctum/csrf-cookie")

    console.log(email.value + password.value)

    const response = await axios.post('/register', {
        first_name: first_name.value,
        last_name: last_name.value,
        username: username.value,
        email: email.value,
        password: password.value,
        password_confirmation: confirm_password.value
    })
    router.push('/login')
} 
</script>