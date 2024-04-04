<template>
  <main class="w-full">

    <div class=" py-10 sm:py-14">
      <div class="mx-auto max-w-7xl ">
        <div class="mx-auto max-w-2xl lg:mx-0">
          <router-link :to="'/feed'" class="text-base font-semibold leading-7 text-indigo-600">Blog app</router-link>
          <h2 class="mt-2 text-4xl font-bold tracking-tight text-white-900 sm:text-6xl">{{ user.first_name + ' ' +
            user.last_name }}</h2>
          <h4 class="mt-2 text-2xl tracking-tight text-white-900 sm:text-2xl">{{ user.email }}</h4>
        </div>
      </div>

      <div v-if="isLoading">
        Loading...
      </div>
      <div v-if="store.blogs.length > 0" class="flex-col gap-y-3 mt-8">
        <BlogCard v-for="blog in store.blogs" :key="blog.id" :blog="blog" />
      </div>

      <div v-else>
        {{ "I'm sorry, there are no blogs from " + user.first_name + " :(" }}
      </div>
      <div class="flex flex-row">
        <button @click="prev"
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-40 basis-1/2 ">Previous
          page</button>
        <button @click="next"
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-40 basis-1/2">Next
          page</button>
      </div>


    </div>
  </main>
</template>
<script setup>
import BlogCard from "@/components/BlogCard.vue";
import { blogsStore } from "@/stores/blogs";
import { onMounted, reactive, ref } from "vue";
import { useRoute } from "vue-router";
import useAxios from "@/composables/useAxios.js"

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