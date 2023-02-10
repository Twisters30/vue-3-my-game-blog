import { defineStore } from "pinia";
import axios from "axios";
import { apiHost, apiLogin, apiLogout} from "~/config/api.js";

export const useLoginStore = defineStore('LoginStore', () => {
    const isLoginPageShow = ref(false);
    const formData = reactive({});
    const token = ref(null);

    const getLocalStorageToken = () => {
        token.value = localStorage.getItem('token') || null;
    }

    const showPage = () => {
        isLoginPageShow.value = !isLoginPageShow.value;
        console.log(isLoginPageShow.value)
    }
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
            console.log(result.data.token);
            token.value = result.data.token;
            localStorage.setItem('token',result.data.token);
        } catch (error) {
            console.log(error);
        }
    }

    const logout = async () => {
        if (!token.value) return;
        try {
            const response = axios.post(`${apiHost}/${apiLogout}`, {
                headers: {
                    'Authorization': `Bearer ${token.value}`
                }
            })
            console.log(response.data);
            if (response.data.status === (200 || 201)) {
                token.value = null;
            }
        } catch (error) {
            console.log(error);
        }
    }

    return { isLoginPageShow, showPage, loginAction, formData, closeModalOutside, token, logout, getLocalStorageToken };
})