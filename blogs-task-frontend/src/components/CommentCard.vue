<template>
    <div class="divide-y divide-gray-100 overflow-hidden rounded-lg bg-indigo-100/25 w-full shadow-lg p-5 mt-4">
            <dl class="divide-y divide-gray-200">
            <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dd class="mt-1 text-base leading-6 text-gray-100 sm:col-span-2 sm:mt-0">{{ comment?.user }}</dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dd class="mt-1 text-base leading-6 text-gray-100 sm:col-span-2 sm:mt-0">{{ comment?.comment }}</dd>
            </div>
            </dl>

    </div>
  
  </template>
  <script setup>
    import router from '@/router';
    const props = defineProps({
      comment: Object
    })
  </script>