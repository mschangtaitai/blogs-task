<template>
  <main class="mt-5">

    <div class="py-10">

      <div>
        <div class="flex flex-row justify-between">
          <div class="text-base font-semibold leading-7 text-indigo-600">Blog app</div>
          <CustomButton @click="logout" text="Logout" />
        </div>
        <div>

          <router-link :to="'/deleted'" class="text-base font-semibold leading-7 text-indigo-600">Deleted
            Blogs!</router-link>
        </div>

        <router-link :to="'/create'" class="text-base font-semibold leading-7 text-indigo-600">Create your own
          blog!</router-link>

        <TitleText text="All your favorite blogs :D" />
      </div>


      <div v-if="isLoading">
        Loading...
      </div>

      <BlogList v-if="store.blogs.length > 0" />

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
<script setup>
import CustomButton from "@/components/CustomButton.vue";
import TitleText from "@/components/TitleText.vue";
import BlogList from "@/components/BlogList.vue"
import router from "@/router";
import { blogsStore } from "@/stores/blogs";
import { useInfiniteScroll } from '@vueuse/core'
import { onMounted, ref } from "vue";
import useAxios from "@/composables/useAxios.js"

const axios = useAxios()
const isLoading = ref(true)
const store = blogsStore()
const el = ref < HTMLElement | null > (null)

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

// async function prev() {
//   isLoading.value = true
//   store.prev()
//   isLoading.value = false
// }

// async function next() {
//   isLoading.value = true
//   store.next()
//   isLoading.value = false
// }

async function logout() {
  console.log("logout")
  // var cookies = document.cookies.split(";")
  // localStorage.removeItem('token')
  // localStorage.removeItem('expiration')
  await axios.post('/logout')
  router.push('/login')
}

</script>