<template>
  <div class="divide-y divide-gray-100 overflow-hidden rounded-lg bg-indigo-100/25 w-full shadow-lg p-5 mt-4">
    <dl class="divide-y divide-gray-200">
      <div class="px-4 py-3">
        <dd class="mt-1 text-base leading-6 text-gray-100">{{ comment?.user }}</dd>
      </div>
      <div class="px-4 py-6 flex flex-col">
        <dd class="mt-1 text-base leading-6 text-gray-100 sm:col-span-2 sm:mt-0">{{ comment?.comment }}</dd>
        <div v-if="isReplying">
          <button @click="reply"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-4 rounded mb-5">Reply
            comment</button>
        </div>
        <div v-else class="mt-5">
          <Form @submit="send">
            <Field v-model="comment_reply" id="comment_reply" name="comment_reply"
              class="block w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
              placeholder="Place your comment reply" type="text" />

            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-4 rounded">Send</button>

          </Form>
        </div>
        <div v-if="comment.comments.length > 0">
          <div v-if="!showMore" @click="displayShowReplies"
            class="text-base font-semibold leading-7 text-indigo-800 cursor-pointer">Show
            replies ({{
          comment.comments.length }})</div>
          <div v-else>
            <div @click="displayShowReplies" class="text-base font-semibold leading-7 text-indigo-800 cursor-pointer">
              Hide
              replies</div>
            <div v-for="commentComment in comment.comments">
              <div class="bg-gray-600 rounded p-2 m-1">
                <div class="font-bold">{{ commentComment.user }}</div>
                <div>{{ commentComment.comment }}</div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </dl>



  </div>

</template>
<script setup>
import { Form, Field } from 'vee-validate';
import { computed, onMounted, reactive, ref } from "vue";
import useAxios from "@/composables/useAxios.js"


const props = defineProps({
  comment: Object
})

const axios = useAxios()
const isReplying = ref(true)
const showMore = ref(false)
const comment_reply = ref(null)

function reply() {
  isReplying.value = false
}

function displayShowReplies() {
  console.log('show more')
  showMore.value = !showMore.value
}

async function send() {
  console.log(props.comment.id)

  const response = await axios.post('/comment', {
    commentable_type: 'Comment',
    commentable_id: props.comment.id,
    comment: comment_reply.value
  })
  location.reload()
}



</script>