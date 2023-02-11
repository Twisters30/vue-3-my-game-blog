import { defineStore } from "pinia";
import axios from "axios";
import { apiHost, apiLogin, apiLogout} from "~/config/api.js";

export const useLoginStore = defineStore('LoginStore', () => {
    const isLoginPageShow = ref(false);
    const formData = reactive({});
    const token = ref(null);
    const acceptWindowShow = ref(false);
    const accept = ref(false);

    const acceptAction = (payloadAccept) => {
        accept.value = payloadAccept;
        isLoginPageShow.value = !acceptWindowShow.value;
    }

    const getLocalStorageToken = () => {
        token.value = localStorage.getItem('token') || null;
    }

    const showPage = () => isLoginPageShow.value = !isLoginPageShow.value;
    const closeModalOutside = (event) => {
        if (event.target.id === 'modal-overlay') {
            showPage();
        }
    }
    const loginAction = async () => {
        try {
            const result = await axios.post(`${apiHost}/${apiLogin}`,{
                email: formData.email,
                password: formData.password
            });
            console.log(result);
            token.value = result.data.token;
            if (result.data.token) {
                localStorage.setItem('token',result.data.token);
            }
        } catch (error) {
            console.log(error);
        }
    }

    const logout = async () => {
        if (!token.value) return;
        acceptWindowShow.value = true;
        try {
            const response = await axios.patch(`${apiHost}/${apiLogout}`,{},
                {
                    headers: {'Authorization': `Bearer ${token.value}`}
                }
            )
            if (response.status === 200) {
                token.value = null;
                localStorage.removeItem('token');
                isLoginPageShow.value = false;
            }
        } catch (error) {
            console.log(error);
        }
    }

    return {
        isLoginPageShow,
        showPage,
        loginAction,
        formData,
        closeModalOutside,
        token,
        logout,
        getLocalStorageToken,
        acceptAction,
        acceptWindowShow
    };
})