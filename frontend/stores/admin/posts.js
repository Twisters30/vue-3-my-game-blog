import { defineStore } from "pinia";
import axios from "axios";
import { apiHost, apiAdminPostsIndex, apiAdminGetPostStatuses, apiAdminPostCreate, apiAdminPostDelete } from "~/config/api.js";
import { useLoginStore } from "~/stores/login.js";
import { useAxiosStore } from "~/stores/axiosInstance.js";


export const useAdminPostsStore = defineStore('adminPostsStore', () => {
    const loginStore = useLoginStore();
    const axiosStore = useAxiosStore();
    const axiosInstance = axiosStore.setConfigAxios();
    const router = useRouter();
    let posts = ref(null);

    const getPostsStore = computed(() => {
        return posts;
    })

    const getByPostId = async (payloadPostId) => {
        if (posts.value === null) {
            console.log('inside IF')
            posts.value = await getPosts();
        }
        return posts.find(({id}) => Number(id) === Number(payloadPostId));
    }
    const tableTitle = 'Редактирование статей';
    const tableHeaders = reactive(
        [
            'id','name','description','image','icon','post_status_id','user_id','created_at','updated_at'
        ]
    )
    const pathUrl = '/admin/posts/';
    const getPostStatuses = async () => {
        const accessToken = loginStore.getAccessToken();
        try {
            const response = await axiosInstance.get(`${apiHost}/${apiAdminGetPostStatuses}`,
                {
                    headers: {'Authorization': `Bearer ${accessToken}`}
                }
            )
            if (response.status === 200) {
                console.log(response.data)
                return response.data;
            }
        } catch (error) {
            console.log(error);
        }
    }
    const createPost = async (data) => {
        const accessToken = loginStore.getAccessToken();
        const bodyFormData = new FormData();
        for (const [key,value] of Object.entries(data)) {
            console.log(key,value)
            bodyFormData.append(key, value);
        }
        console.log(bodyFormData);
        try {
            const response = await axiosInstance.post(`${apiHost}/${apiAdminPostCreate}`,
                    bodyFormData,
                {
                    headers: {
                        'Authorization': `Bearer ${accessToken}`,
                        'Content-Type': 'multipart/form-data'},
                }
            )
            if (response.status === 200) {
                console.log('Статья создана');
            }
        } catch (error) {
            console.log(error);
        }
    }
    const getPosts = async () => {
        const accessToken = loginStore.getAccessToken();
        console.log(accessToken, 'storeAdminPosts');
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
            // router.push({path: '/'});
        }
    }

    const deletePost = async (id) => {
        const accessToken = loginStore.getAccessToken();
        console.log(id)
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

    return { getPosts, pathUrl, tableHeaders, tableTitle, getByPostId, getPostStatuses, createPost, deletePost, getPostsStore, posts };
})