import { defineStore } from "pinia";
import axios from "axios";
import {
    apiHost,
    apiAdminPostsIndex,
    apiAdminGetPostStatuses,
    apiAdminPostCreate,
    apiAdminPostDelete,
    apiAdminChangePostStatus
} from "~/config/api.js";
import { useLoginStore } from "~/stores/login.js";
import { useAxiosStore } from "~/stores/axiosInstance.js";
import { fileFormData } from "~/helpers/fileFormData.js";


export const useAdminPostsStore = defineStore('adminPostsStore', () => {
    const loginStore = useLoginStore();
    const axiosStore = useAxiosStore();
    const axiosInstance = axiosStore.setConfigAxios();
    const router = useRouter();
    let posts = ref(null);

    function getCookie(name) {
        let matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }
    const getByPostId = async (payloadPostId) => {
        console.log(payloadPostId)
        if (posts.value === null) {
            posts.value = await getPosts();
        }
        return posts.value.find((post) => Number(post.id) === Number(payloadPostId));
    }
    const tableTitle = 'Редактирование статей';
    const tableHeaders = reactive(
        [
            'id','name','description','image','icon','post_status_id','user_id','created_at','updated_at'
        ]
    )
    const getPostStatuses = async () => {
        const accessToken = loginStore.getAccessTokenStorage();
        try {
            const response = await axiosInstance.get(`${apiHost}/${apiAdminGetPostStatuses}`,
                {
                    headers: {'Authorization': `Bearer ${accessToken}`}
                }
            )
            if (response.status === 200) {
                return response.data;
            }
        } catch (error) {
            console.log(error);
        }
    }
    const createOrUpdatePost = async (post) => {
        const accessToken = loginStore.getAccessToken();
        const bodyFormData = fileFormData(post);
        try {
            const response = await axiosInstance.post(`${apiHost}/${apiAdminPostCreate}`,
                bodyFormData,
                {
                    headers:
                        {
                        'Authorization': `Bearer ${accessToken}`,
                        'Content-Type': 'multipart/form-data'
                    },
                }
            )
            if (response.status === 200) {
                console.log('Статья создана');
            }
        } catch (error) {
            console.log(error);
        }
    }
    const changePostStatus = async (postStatus) => {
        const accessToken = loginStore.getAccessToken();
        console.log(postStatus)
        try {
            const response = await axiosInstance.post(`${apiHost}/${apiAdminChangePostStatus}`,
                postStatus,
                {
                    headers: {
                        'Authorization': `Bearer ${accessToken}`
                    },
                }
            )
            if (response.status === 200) {
                console.log('Статус изменён');
            }
        } catch (error) {
            console.log(error);
        }
    }

    const getPosts = async () => {
        const accessToken = loginStore.getAccessToken();
        try {
            const response = await axiosInstance.get(`${apiHost}/${apiAdminPostsIndex}`,
                {
                    headers: {'Authorization': `Bearer ${accessToken}`}
                }
            )
            if (response.status === 200) {
                posts.value = response.data;
                return response.data;
            }
        } catch (error) {
            console.log(error);
        }
    }

    const deletePost = async (id) => {
        const accessToken = loginStore.getAccessToken();
        try {
            const response = await axiosInstance.delete(`${apiHost}/${apiAdminPostDelete}`,{
                data: {
                    id
                },
                headers: {'Authorization': `Bearer ${accessToken}`}
            });
            if (response.status === 200) {
                console.log('Стаья удалена');
                posts.value = posts.value.filter((post) => post.id !== id);
                console.log(posts.value, 'отфильтрованно')
            }
        } catch (error) {
            console.log(error);
            console.log('Ошибка при удалении статьи')
        }
    }

    return {
        getPosts,
        tableHeaders,
        tableTitle,
        getByPostId,
        getPostStatuses,
        createOrUpdatePost,
        deletePost,
        posts,
        changePostStatus };
})