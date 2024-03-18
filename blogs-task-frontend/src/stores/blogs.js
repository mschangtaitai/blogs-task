
import { defineStore } from 'pinia'
import { ref, reactive } from 'vue'
import useAxios from "@/composables/useAxios.js"

export const blogsStore = defineStore('item', () => {
    const axios = useAxios()
    let blogs = reactive([])
    const prevLink = ref("")
    const nextLink = ref("")

    async function fill() {
        try {
            blogs.splice(0)
            const response = await axios.get("/api/feed?page=1")
            const data = response.data.data
            prevLink.value = response.data.prev_page_url
            nextLink.value = response.data.next_page_url

            for (const blog in data) {
                blogs.push(data[blog])
            }
        } catch (error) {
        }
    }

    async function prev() {
        if (prevLink.value) {
            const response = await axios.get(prevLink.value.substr(16))
            const data = response.data.data
            prevLink.value = response.data.prev_page_url
            nextLink.value = response.data.next_page_url
            blogs.splice(0)
            for (const blog in data) {
                blogs.push(data[blog])
            }
        }
    }

    async function next() {
        if (nextLink.value) {
            const response = await axios.get(nextLink.value.substr(16))
            const data = response.data.data
            prevLink.value = response.data.prev_page_url
            nextLink.value = response.data.next_page_url
            blogs.splice(0)
            for (const blog in data) {
                blogs.push(data[blog])
            }
        }
    }

    return { blogs, fill, prev, next }
})