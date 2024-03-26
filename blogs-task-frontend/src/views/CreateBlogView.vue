<template>
    <div class="mx-auto max-w-2xl text-center">
        <h2 class="text-4xl font-bold tracking-tight text-blue-900 sm:text-6xl py-5">Create your own blog!</h2>
    </div>
    <Form @submit="submit" class="rounded-xl px-20 py-10 sm:py-14 bg-gray-600">
        <div class="font-bold py-2">Title</div>
        <Field v-model="title" id="title" name="title"
            class="block w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            placeholder="Title" type="text" />
        <div class="font-bold py-2">Content</div>
        <Field v-model="content" id="content" name="content"
            class="h-96 block w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            placeholder="Place your content" type="text" />

        <label class="w-full py-4 inline-flex items-center cursor-pointer">
            <input type="checkbox" value="" class="sr-only peer">
            <div
                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
            </div>
            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Hide comments</span>
        </label>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-4 rounded">Submit</button>


    </Form>

</template>
<script setup>
import { computed, onMounted, reactive, ref } from "vue";
import { useRouter } from "vue-router";
import { Form, Field } from 'vee-validate';

import useAxios from "@/composables/useAxios.js"

const axios = useAxios()
const router = useRouter()

const title = ref(null)
const content = ref(null)
const hideComments = ref(false)

async function submit() {
    console.log(title.value + content.value)

    const response = await axios.post('/login', {
        title: title.value,
        content: content.value
    })
    router.push('/blog')
}
</script>