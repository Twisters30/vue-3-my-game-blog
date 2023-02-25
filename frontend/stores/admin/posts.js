import { defineStore } from "pinia";
import axios from "axios";
import { apiHost, apiAdminPostsIndex } from "~/config/api.js";
import { useLoginStore } from "~/stores/login.js";

export const useAdminPostsStore = defineStore('adminPostsStore', () => {
    const loginStore = useLoginStore();
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
    return { getPosts, pathUrl, tableHeaders, tableTitle, getByPostId, posts };
})