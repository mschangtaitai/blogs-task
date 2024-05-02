<template>
  <div v-if="isLoading">
    Loading...
  </div>
  <div v-else class="px-6 py-10 sm:py-14 bg-gray-700 rounded-3xl">
    <div class="mx-auto max-w-2xl flex-col">
      <!-- <h2 class="text-4xl font-bold tracking-tight text-gray-100 sm:text-6xl">{{ blog.title }}</h2> -->
      <TitleText :text="blog.title" />
      <p class="mt-6 text-lg leading-8 text-gray-300" v-html="blog.content"></p>
      <CustomButton @click="deleteBlog" text="Delete" />

      <div v-if="blog.hide_comments == false">

        <h3 class="text-2xl text-gray-100 sm:text-3xl pt-10">Comments</h3>
        <div v-if="blog.comments.length > 0" class="flex-col gap-y-3 mt-8">
          <CommentCard v-for=" comment  in  blog.comments " :key="comment.id" :comment="comment" />
        </div>
        <div
          class="divide-y divide-gray-200 bg-gray-400 overflow-hidden rounded-lg bg-indigo-100/25 w-full shadow-lg p-5 mt-4">
          <dl class="divide-y divide-gray-200">
            <div class="px-4 py-3">
              <dd class="mt-1 text-base leading-6 text-gray-100 sm:col-span-2 sm:mt-0">Leave your comment!</dd>
            </div>
            <div class="px-4 py-6">
              <Form @submit="send">
                <InputField v-model="comment" id="comment" name="comment" placeholder="Place your comment"
                  type="text" />
                <CustomButton2 text="Send" />

              </Form>
            </div>
          </dl>

        </div>
      </div>
      <div v-else>
        <h3 class="text-2xl text-gray-100 sm:text-3xl pt-10">Creator turned off comments :(</h3>
      </div>
    </div>
  </div>

</template>
<style>
ol {
  list-style-type: decimal;
  list-style-position: inside;
  padding: 0%;
}

ul {
  list-style-type: disc;
  list-style-position: inside;
  padding: 0%;
}
</style>
<script setup>
import { onMounted, reactive, ref } from "vue";
import { useRoute } from "vue-router";
import CommentCard from "@/components/CommentCard.vue";
import InputField from "@/components/InputField.vue";
import CustomButton from "@/components/CustomButton.vue";
import CustomButton2 from "@/components/CustomButton2.vue";
import TitleText from "@/components/TitleText.vue";
import { Form } from 'vee-validate';


import useAxios from "@/composables/useAxios.js"
import router from "@/router";

const axios = useAxios()
const route = useRoute()
const blog = reactive({})
const isLoading = ref(true)
const comment = ref(null)


onMounted(async () => {

  const id = route.params.id
  const response = await axios.get(`/blogs/${id}`)
  console.log(response.data)
  Object.assign(blog, response.data)
  isLoading.value = false
})

async function send() {

  const response = await axios.post('/comments', {
    commentableType: 'Blog',
    commentableId: blog.id,
    comment: comment.value
  })
  location.reload()
}

async function deleteBlog() {

  const response = await axios.delete(`/blogs/${blog.id}`)
  router.push('/feed')
}
</script>