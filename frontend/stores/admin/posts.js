import { defineStore } from "pinia";
import axios from "axios";
import { apiHost, apiAdminPostsIndex, apiAdminGetPostStatuses, apiAdminCreatePost } from "~/config/api.js";
import { useLoginStore } from "~/stores/login.js";
import { useAxiosStore } from "~/stores/axiosInstance.js";


export const useAdminPostsStore = defineStore('adminPostsStore', () => {
    const loginStore = useLoginStore();
    const axiosStore = useAxiosStore();
    const axiosInstance = axiosStore.setConfigAxios();
    const posts = reactive([
        {
            id:1,
            name: 'testName',
            description: 'test lorem test loremtest lorem test lorem test lorem test lorem test lorem test lorem test lorem',
            image: '/img/test.jpg',
            icon:'/icons/gameIcon.jpg',
            post_status_id:1,
            user_id:1,
            created_at: new Date(),
            updated_at: new Date()
        },{
            id:2,
            name: 'testName',
            description: 'test lorem test loremtest lorem test lorem test lorem test lorem test lorem test lorem test lorem',
            image: '/img/test.jpg',
            icon:'/icons/gameIcon.jpg',
            post_status_id:2,
            user_id:2,
            created_at: new Date(),
            updated_at: new Date()
        },
    ]);
    const getByPostId = (payloadPostId) => {
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
            const response = await axiosInstance.post(`${apiHost}/${apiAdminCreatePost}`,
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
        const router = useRouter();
        try {
            const response = await axiosInstance.get(`${apiHost}/${apiAdminPostsIndex}`,
                {
                    headers: {'Authorization': `Bearer ${accessToken}`}
                }
            )
            if (response.status === 200) {
            }
        } catch (error) {
            console.log(error);
            router.push({path: '/'});
        }
    }
    return { getPosts, pathUrl, tableHeaders, tableTitle, getByPostId, posts, getPostStatuses, createPost };
})