<template>
  <div class="divide-y divide-gray-100 overflow-hidden rounded-lg bg-indigo-100/25 w-full shadow-lg p-5 mt-4">
    <dl class="divide-y divide-gray-200">
      <div class="px-4 py-3">
        <dd class="mt-1 text-base leading-6 text-gray-100">{{ comment?.user }}</dd>
      </div>
      <div class="px-4 py-6 flex flex-col">
        <dd class="mt-1 text-base leading-6 text-gray-100 sm:col-span-2 sm:mt-0">{{ comment?.comment }}</dd>
        <div v-if="isReplying">
          <CustomButton2 @click="reply" text="Reply comment" </CustomButton2>
        </div>
        <div v-else class="mt-5">
          <Form @submit="send">
            <InputField v-model="comment_reply" id="comment_reply" name="comment_reply"
              placeholder="Place your comment reply" type="text" />

            <CustomButton2 text="Send" </CustomButton2>
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
import InputField from './InputField.vue';
import CustomButton2 from './CustomButton2.vue';


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

  const response = await axios.post('/comments', {
    commentable_type: 'Comment',
    commentable_id: props.comment.id,
    comment: comment_reply.value
  })
  location.reload()
}



</script>