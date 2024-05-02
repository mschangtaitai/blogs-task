<template>
    <div class="mx-auto max-w-2xl text-center">
        <TitleText class="text-blue-900" text="Blogs app" />
        <p class="mt-6 text-lg leading-8 text-white-600">Sign up the best blogs app!</p>
    </div>
    <Form @submit="login" class="rounded-xl px-20 py-10 sm:py-14 bg-gray-600">
        <div class="font-bold py-2">First Name</div>
        <InputField v-model="first_name" id="first name" name="first name" placeholder="First name" type="string" />
        <div class="font-bold py-2">Last Name</div>
        <InputField v-model="last_name" id="last name" name="last name" placeholder="Last name" type="string" />
        <div class="font-bold py-2">Username</div>
        <InputField v-model="username" id="username" name="username" placeholder="Username" type="string" />
        <div class="font-bold py-2">Email</div>
        <InputField v-model="email" id="email" name="email" placeholder="Email" type="mail" />
        <div class="font-bold py-2">Password</div>
        <InputField v-model="password" id="password" name="password" placeholder="Password" type="password" />
        <div class="font-bold py-2">Confirm password</div>
        <InputField v-model="confirm_password" id="confirm password" name="confirm password"
            placeholder="Confirm Password" type="password" />

        <CustomButton2 text="Sign up" />

        <RouterLink :to="'/login/'" class="my-2">
            <dd class="text-base leading-6 text-gray-100 sm:col-span-2 sm:mt-0">Already have an account? Log in!</dd>
        </RouterLink>


    </Form>

</template>
<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import { Form } from 'vee-validate';
import InputField from "@/components/InputField.vue";
import TitleText from "@/components/TitleText.vue";
import CustomButton2 from "@/components/CustomButton2.vue";


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