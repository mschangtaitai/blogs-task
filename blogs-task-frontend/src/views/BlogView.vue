<template>
  <div v-if="isLoading">
    Loading...
  </div>
  <div v-else class="px-6 py-10 sm:py-14 bg-gray-700 rounded-3xl">
    <div class="mx-auto max-w-2xl flex-col">
      <h2 class="text-4xl font-bold tracking-tight text-gray-100 sm:text-6xl">{{ blog.title }}</h2>
      <p class="mt-6 text-lg leading-8 text-gray-300">{{ blog.content }}</p>
      <p class="mt-6 text-lg leading-8 text-gray-300">mus mauris vitae ultricies leo integer malesuada nunc vel risus
        commodo viverra maecenas accumsan lacus vel facilisis volutpat est velit egestas dui id ornare arcu odio ut sem
        nulla pharetra diam sit amet nisl suscipit adipiscing bibendum est ultricies integer quis auctor elit sed
        vulputate mi sit amet mauris commodo quis imperdiet massa tincidunt nunc pulvinar sapien et ligula ullamcorper
        malesuada proin libero nunc consequat interdum varius sit amet mattis vulputate enim nulla aliquet porttitor
        lacus luctus accumsan tortor posuere ac ut consequat semper viverra nam libero justo laoreet sit amet cursus sit
        amet dictum sit amet justo donec enim diam vulputate ut pharetra sit amet aliquam id diam maecenas ultricies mi
        eget mauris pharetra et ultrices neque ornare aenean euismod elementum nisi quis eleifend quam adipiscing vitae
        proin sagittis nisl rhoncus mattis rhoncus urna neque viverra justo nec ultrices dui sapien eget mi proin sed
        libero enim sed faucibus turpis in eu mi bibendum neque egestas congue quisque egestas diam in arcu cursus
        euismod quis viverra nibh cras pulvinar mattis nunc sed blandit libero volutpat sed cras ornare arcu dui vivamus
        arcu felis bibendum ut tristique et egestas quis ipsum suspendisse ultrices gravida dictum fusce ut placerat
        orci nulla</p>
      <h3 class="text-2xl text-gray-100 sm:text-3xl pt-10">Comments</h3>
      <div v-if="blog.comments.length > 0" class="flex-col gap-y-3 mt-8">
        <CommentCard v-for="comment in blog.comments" :key="comment.id" :comment="comment" />
      </div>
      <div
        class="divide-y divide-gray-200 bg-gray-400 overflow-hidden rounded-lg bg-indigo-100/25 w-full shadow-lg p-5 mt-4">
        <dl class="divide-y divide-gray-200">
          <div class="px-4 py-3">
            <dd class="mt-1 text-base leading-6 text-gray-100 sm:col-span-2 sm:mt-0">Leave your comment!</dd>
          </div>
          <div class="px-4 py-6">
            <Form @submit="send">
              <Field v-model="comment" id="comment" name="comment"
                class="block w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                placeholder="Place your comment" type="text" />

              <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-4 rounded">Send</button>

            </Form>
          </div>
        </dl>

      </div>
    </div>
  </div>

</template>
<script setup>
import { computed, onMounted, reactive, ref } from "vue";
import { useRoute } from "vue-router";
import CommentCard from "@/components/CommentCard.vue";
import { Form, Field } from 'vee-validate';


import useAxios from "@/composables/useAxios.js"

const axios = useAxios()
const route = useRoute()
const blog = reactive({})
const isLoading = ref(true)
const comment = ref(null)


onMounted(async () => {

  const id = route.params.id
  const response = await axios.get(`/blog/${id}`)
  Object.assign(blog, response.data)
  isLoading.value = false
})

async function send() {

  const response = await axios.post('/comment', {
    commentable_type: 'Blog',
    commentable_id: blog.id,
    comment: comment.value
  })
  location.reload()
}
</script>