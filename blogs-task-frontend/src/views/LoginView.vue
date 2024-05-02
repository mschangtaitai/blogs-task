<template>
  <div class="mx-auto max-w-2xl text-center">
    <TitleText class="text-blue-900" text="Blogs app" />
    <p class="mt-6 text-lg leading-8 text-white-600">Log in to the best blogs app!</p>
  </div>
  <Form @submit="login" class="rounded-xl px-20 py-10 sm:py-14 bg-gray-600">
    <div class="font-bold py-2">Email</div>
    <InputField v-model="email" id="email" name="email" placeholder="Email" type="mail" />
    <div class="font-bold py-2">Password</div>
    <InputField v-model="password" id="password" name="password" placeholder="Password" type="password" />

    <CustomButton2 text="Login" />


    <RouterLink :to="'/signup/'" class="my-2">
      <dd class="text-base leading-6 text-gray-100 sm:col-span-2 sm:mt-0">Don't have an account? Sign up!</dd>
    </RouterLink>
  </Form>

</template>
<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import { Form } from 'vee-validate';
import CustomButton2 from "@/components/CustomButton2.vue";
import InputField from "@/components/InputField.vue";
import TitleText from "@/components/TitleText.vue";


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