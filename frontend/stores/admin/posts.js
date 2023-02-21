import { defineStore } from "pinia";
import axios from "axios";
import { apiHost, apiAdminPostsIndex } from "~/config/api.js";
import { useLoginStore } from "~/stores/login.js";

export const useAdminStore = defineStore('adminStore', () => {
    const loginStore = useLoginStore();
    const getPosts = async () => {
        const accessToken = loginStore.getStorageToken();
        console.log(accessToken, 'storeAdminPosts');
        try {
            const response = await axios.get(`${apiHost}/${apiAdminPostsIndex}`,
                {
                    headers: {'Authorization': `Bearer ${accessToken}`}
                }
            )
            if (response.status === 200) {

            }
        } catch (error) {
            console.log(error);
        }
    }
    return { getPosts };
})