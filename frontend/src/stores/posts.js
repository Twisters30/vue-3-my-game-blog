import { defineStore } from "pinia";
import { apiHost } from "~/config/api.js";
import { ref } from "vue";
import axios from "axios";

export const usePostsStore = defineStore("postsStore", () => {
  const posts = ref(null);

  const getPosts = async () => {
    if (!posts.value) {
      try {
        const response = await axios.get(`${apiHost}`);

        if (response.status === 200) {
          posts.value = response.data;
        }
      } catch (error) {
        console.log(error);
      }
    }
    return posts.value;
  };

  return { getPosts };
});
