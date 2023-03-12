import { defineStore } from "pinia";
import { apiHost, apiGetPosts } from "~/config/api.js";
import { ref } from "vue";
import axios from "axios";

export const usePostsStore = defineStore("postsStore", () => {
  const posts = ref(null);

  const getPosts = async () => {
    if (!posts.value) {
      console.log(posts);
    }
    try {
      const response = await axios.get(`${apiHost}/${apiGetPosts}`);

      if (response.status === 200) {
        posts.value = response.data;
      }
    } catch (error) {
      console.log(error);
    }
    return posts.value;
  };

  return { getPosts };
});
