<template>
    <div class="mx-auto max-w-2xl text-center">
        <h2 class="text-4xl font-bold tracking-tight text-blue-900 sm:text-6xl py-5">Create your own blog!</h2>
    </div>
    <Form @submit="submit" class="rounded-xl px-20 py-10 sm:py-14 bg-gray-600">
        <div class="font-bold py-2">Title</div>
        <Field v-model="title" id="title" name="title"
            class="w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            placeholder="Title" type="text" />
        <div class="font-bold py-2">Content</div>
        <div id="my-toolbar" class="rounded-md bg-white">
            <button class="ql-bold"></button>
            <button class="ql-italic"></button>
            <button class="ql-underline"></button>
            <button class="ql-list" value="ordered"></button>
            <button class="ql-list" value="bullet"></button>
            <button class="ql-direction" value="rtl"></button>
        </div>
        <QuillEditor v-model:content="content" toolbar="#my-toolbar" content-type="html"
            class="rounded-md border-0 bg-white py-1.5 pl-10 pr-3 text-gray-900">
        </QuillEditor>
        <!-- <QuillEditor v-model="content" toolbar="minimal" theme="snow"
            class="w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 text-gray-900" /> -->

        <label class="w-full py-4 inline-flex items-center cursor-pointer">
            <input type="checkbox" id="hideComments" v-model="hideComments" class="sr-only peer">
            <div
                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
            </div>
            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Hide comments</span>
        </label>

        <div class="font-bold py-2">Available at date</div>
        <Field v-model="available_at_date" id="available_at_date" name="available_at_date"
            class="block w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            placeholder="Pick your date" type="date" />

        <div class="font-bold py-2">Available at hour</div>
        <Field v-model="available_at_hour" id="available_at_hour" name="available_at_hour"
            class="block w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            placeholder="Pick your hour" type="time" />


        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-4 rounded">Submit</button>


    </Form>

</template>
<script setup>
import { computed, onMounted, reactive, ref } from "vue";
import { useRouter } from "vue-router";
import { Form, Field } from 'vee-validate';
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css'
import useAxios from "@/composables/useAxios.js"

const axios = useAxios()
const router = useRouter()

const title = ref(null)
const content = ref(null)
const hideComments = ref(false)
const available_at_date = ref(null)
const available_at_hour = ref(null)

async function submit() {
    console.log(content.value)

    // const response = await axios.delete('/blog/16', {
    // })

    const response = await axios.post('/blog', {
        title: title.value,
        content: content.value,
        hide_comments: hideComments.value,
        available_at: available_at_date.value + " " + available_at_hour.value + ":00"

    })
}
</script>