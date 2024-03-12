<template>
  <RouterLink :to="'/blog/' + blog?.id">

    <div class="divide-y divide-gray-100 overflow-hidden rounded-lg bg-indigo-100/25 w-full shadow-lg">
      <div class="px-4 py-5 sm:p-6">
        <dl class="divide-y divide-gray-200">
          <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-400">Title</dt>
            <dd class="mt-1 text-base leading-6 text-gray-100 sm:col-span-2 sm:mt-0">{{ blog?.title }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-400">Author</dt>
            <!-- TODO Fix this interpolation -->
            <dd class="mt-1 text-base leading-6 text-gray-100 sm:col-span-2 sm:mt-0">{{ blog?.user.first_name + ' ' + blog?.user.last_name }}</dd>
          </div>
        </dl>

      </div>
    </div>
  </RouterLink>

</template>
<script setup>
  import router from '@/router';
  import { RouterLink } from 'vue-router';
  const props = defineProps({
    blog: Object
  })

  function open() {
    router.push(`/blog/${props.blog?.id}`)
  }


</script>