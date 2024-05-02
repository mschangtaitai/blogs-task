<template>
  <main class="w-full">

    <div class=" py-10 sm:py-14">
      <router-link :to="'/feed'" class="text-base font-semibold leading-7 text-indigo-600">Blog app</router-link>
      <TitleText :text="user.first_name + ' ' + user.last_name" />
      <h4 class="mt-2 text-2xl tracking-tight text-white-900 sm:text-2xl">{{ user.email }}</h4>

      <div v-if="isLoading">
        Loading...
      </div>
      <BlogList v-if="store.blogs.length > 0" />

      <div v-else>
        {{ "I'm sorry, there are no blogs from " + user.first_name + " :(" }}
      </div>
      <div class="flex flex-row">
        <CustomButton2 @click="prev" class="basis-1/2 mr-40" text="Previous page" />
        <CustomButton2 @click="next" class="basis-1/2 ml-40" text="Next page" />
      </div>


    </div>
  </main>
</template>
<script setup>
import { blogsStore } from "@/stores/blogs";
import { onMounted, reactive, ref } from "vue";
import { useRoute } from "vue-router";
import useAxios from "@/composables/useAxios.js"
import CustomButton2 from "@/components/CustomButton2.vue";
import TitleText from "@/components/TitleText.vue";
import BlogList from "@/components/BlogList.vue"

const axios = useAxios()
const isLoading = ref(true)
const route = useRoute()
const store = blogsStore()
const user = reactive({})

onMounted(async () => {
  const id = route.params.user
  const response = await axios.get(`/getuser/${id}`)
  Object.assign(user, response.data)
  store.user_fill(id)
  console.log(store.blogs)
  isLoading.value = false
})

async function prev() {
  isLoading.value = true
  store.prev()
  isLoading.value = false
}

async function next() {
  isLoading.value = true
  store.next()
  isLoading.value = false
}

</script>