<template>
    <Button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-4 rounded mb-5">{{ text }}</Button>
</template>

<script setup>
const props = defineProps({
    text: String
})
</script>