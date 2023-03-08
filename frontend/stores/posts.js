import { defineStore } from 'pinia';
import { apiAdminPostsIndex, apiHost } from "~/config/api.js";
import axios from "axios";

const usePostsStore = defineStore('postsStore', () => {
    const posts = ref(null);
    const getPosts = async () => {
        try {
            const response = await axios.get(`${apiHost}/${apiAdminPostsIndex}`)
            if (response.status === 200) {
                posts.value = response.data;
                return response.data;
            }
        } catch (error) {
            console.log(error);
        }
    }
    return { posts, getPosts };
})