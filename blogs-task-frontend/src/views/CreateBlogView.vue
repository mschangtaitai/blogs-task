<template>
    <TitleText class="text-blue-900" text="Create your own blog!" />
    <Form @submit="submit" class="rounded-xl px-20 py-10 sm:py-14 bg-gray-600">
        <div class="font-bold py-2">Title</div>
        <InputField v-model="title" id="title" name="title" placeholder="Title" type="text" />

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

        <SwitchField id="hideComments" vmodel="hideComments" text="Hide Comments" />

        <div class="font-bold py-2">Available at date</div>
        <InputField v-model="available_at_date" id="available_at_date" name="available_at_date"
            placeholder="Pick your date" type="date" />

        <div class="font-bold py-2">Available at hour</div>
        <InputField v-model="available_at_hour" id="available_at_hour" name="available_at_hour"
            placeholder="Pick your hour" type="time" />
        <CustomButton2 text="Submit" />
    </Form>
</template>
<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import { Form } from 'vee-validate';
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css'
import useAxios from "@/composables/useAxios.js"
import InputField from "@/components/InputField.vue";
import CustomButton2 from "@/components/CustomButton2.vue";
import TitleText from "@/components/TitleText.vue";
import SwitchField from "@/components/SwitchField.vue";

const axios = useAxios()
const router = useRouter()

const title = ref(null)
const content = ref(null)
const hideComments = ref(false)
const available_at_date = ref(null)
const available_at_hour = ref(null)

async function submit() {
    console.log(content.value)

    // const response = await axios.delete('/blogs/16', {
    // })

    const response = await axios.post('/blogs', {
        title: title.value,
        content: content.value,
        hideComments: hideComments.value,
        availableAt: available_at_date.value + " " + available_at_hour.value + ":00"

    })

    router.push('/feed')

}
</script>