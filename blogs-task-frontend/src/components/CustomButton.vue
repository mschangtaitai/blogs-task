<template>
    <Button class="text-base font-semibold leading-7 text-red-600 cursor-pointer">{{ text }}</Button>
</template>

<script setup>
const props = defineProps({
    text: String
})
</script>