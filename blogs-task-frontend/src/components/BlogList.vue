<template>
    <div ref="el" class="flex-col gap-y-3">
        <BlogCard v-for="blog in store.blogs" :key="blog.id" :blog="blog" />
    </div>
</template>

<script setup>
import { blogsStore } from "@/stores/blogs";
import BlogCard from "@/components/BlogCard.vue";

const store = blogsStore()
</script>
