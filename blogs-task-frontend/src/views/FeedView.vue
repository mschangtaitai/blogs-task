<template>
  <main class="w-full">

    <div class=" py-10 sm:py-14">
      <div class="mx-auto max-w-7xl ">
        <div class="mx-auto max-w-2xl lg:mx-0">
          <p class="text-base font-semibold leading-7 text-indigo-600">Blog app</p>
          <h2 class="mt-2 text-4xl font-bold tracking-tight text-white-900 sm:text-6xl">All your favorite blogs :D</h2>
        </div>
      </div>

      <div v-if="isLoading">
        Loading...
      </div>

      <!-- <div ref="el" class="flex flex-col gap-2 p-4 w-300px h-300px m-auto overflow-y-scroll bg-gray-500/5 rounded">
        <div v-for="item in data" :key="item" class="h-15 bg-gray-500/5 rounded p-3">
          {{ item }}
        </div>
      </div> -->

      <div ref="el" v-if="store.blogs.length > 0" class="flex-col gap-y-3 mt-8">
        <BlogCard v-for="blog in store.blogs" :key="blog.id" :blog="blog" />
      </div>

      <div v-else>
        I'm sorry, there are no Blogs :(
      </div>
      <!-- <div class="flex flex-row">
        <button @click="prev"
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-40 basis-1/2 ">Previous
          page</button>
        <button @click="next"
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-40 basis-1/2">Next
          page</button>
      </div> -->


    </div>
  </main>
</template>
<script setup lang="ts">
import BlogCard from "@/components/BlogCard.vue";
import { blogsStore } from "@/stores/blogs";
import { useInfiniteScroll } from '@vueuse/core'

import { onMounted, ref } from "vue";
const isLoading = ref(true)
const store = blogsStore()
const el = ref<HTMLElement | null>(null)


useInfiniteScroll(
  el,
  () => {
    // load more
    store.load_more()
    console.log("load More")

  },
  {
    interval: 1000
  }
)

onMounted(async () => {
  store.fill()
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