
<template>
  <main class="w-full">

    <div class=" py-10 sm:py-14">
      <div class="mx-auto max-w-7xl ">
        <div class="mx-auto max-w-2xl lg:mx-0">
          <p class="text-base font-semibold leading-7 text-indigo-600">Blog app</p>
          <h2 class="mt-2 text-4xl font-bold tracking-tight text-white-900 sm:text-6xl">All your favorite blogs :D</h2>
        </div>
        <!-- <div class="flex items-center my-2">
          <div class="w-full max-w-lg lg:max-w-xs pt-5">
            <label for="search" class="sr-only">Search</label>
            <div class="relative">
              <input v-model="search" id="search" name="search"
                class="block w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                placeholder="Search" type="search" />
            </div>
          </div>
        </div> -->
      </div>

      <div v-if="isLoading">
        Loading...
      </div>
      <div v-if="blogs.length > 0"
        class="flex-col gap-y-3 mt-8">
        <BlogCard v-for="blog in blogs" :key="blog.id" :blog="blog" />
      </div>

      <div v-else>
        I'm sorry, there are no Blogs :(
      </div>

    </div>
  </main>
</template>
<script setup>
  import useAxios from "@/composables/useAxios.js"
  import BlogCard from "@/components/BlogCard.vue";
  
  import { computed, onMounted, reactive, ref, defineModel } from "vue";
  const axios = useAxios()
  const blogs = reactive([])
  const search = ref("")
  const isLoading = ref(true)
  onMounted(async () => {
    try {
      const response = await axios.get("/api/feed?page=1")
      const data = response.data.data
      for (const blog in data){
        blogs.push(data[blog])
      }
      console.log(blogs)
      isLoading.value = false
    } catch (error) {
      isLoading.value = false
    }
    const filteredBlogs = computed(() => {
        const filtered = tempBlogs.filter(blog => (blog.title.toLowerCase().includes(search.value.toLowerCase())))
        return filtered
    })

  })

</script>