<template>
    <h2 class="mt-2 font-bold text-white-900 sm:text-6xl">{{ text }}</h2>
</template>


<script setup>
const props = defineProps({
    text: String
})
</script>