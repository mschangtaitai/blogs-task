<template>
  <div class="mx-auto max-w-2xl text-center">
    <h2 class="text-4xl font-bold tracking-tight text-blue-900 sm:text-6xl">Blogs app</h2>
    <p class="mt-6 text-lg leading-8 text-white-600">Log in to the best blogs app!</p>
  </div>
  <Form @submit="login" class="rounded-xl px-20 py-10 sm:py-14 bg-gray-600">
    <div class="font-bold py-2">Email</div>
    <Field v-model="email" id="email" name="email"
      class="block w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
      placeholder="Email" type="mail" />
    <div class="font-bold py-2">Password</div>
    <Field v-model="password" id="password" name="password"
      class="block w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
      placeholder="Password" type="password" />

    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-4 rounded mb-5">Log In</button>


    <RouterLink :to="'/signup/'" class="my-2">
      <dd class="text-base leading-6 text-gray-100 sm:col-span-2 sm:mt-0">Don't have an account? Sign up!</dd>
    </RouterLink>
  </Form>

</template>
<script setup>
import { computed, onMounted, reactive, ref } from "vue";
import { useRouter } from "vue-router";
import { Form, Field } from 'vee-validate';

import useAxios from "@/composables/useAxios.js"

const axios = useAxios()
const router = useRouter()

const email = ref(null)
const password = ref(null)

async function login() {
  await axios.get("sanctum/csrf-cookie")
  console.log(email.value + password.value)

  const response = await axios.post('/login', {
    email: email.value,
    password: password.value
  })
  router.push('/feed')
} 
</script>