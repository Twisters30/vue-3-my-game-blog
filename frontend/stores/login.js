import { defineStore } from "pinia";
import axios from "axios";
import { apiHost, apiLogin, apiLogout} from "~/config/api.js";

export const useLoginStore = defineStore('LoginStore', () => {
    const isLoginPageShow = ref(false);
    const formData = reactive({});
    const token = ref(null);
    const acceptWindowShow = ref(false);

    const updateFormDataFromRegister = ({email, password}) => {
        console.log(email,password)
        formData.email = email;
        formData.password = password;
    }

    const acceptAction = async (userAnswer = null) => {
        if (userAnswer === null) {
            acceptWindowShow.value = false;
            return;
        }
        if (userAnswer === true) {
           await logout();
        }
        acceptWindowShow.value = !acceptWindowShow.value;
    }

    const getLocalStorageToken = () => {
        token.value = localStorage.getItem('token') || null;
    }

    const showLoginPage = () => isLoginPageShow.value = !isLoginPageShow.value;
    const closeModalOutside = (event) => {
        if (event.target.id === 'modal-overlay') {
            showLoginPage();
        }
    }
    const loginAction = async () => {
        try {
            const response = await axios.post(`${apiHost}/${apiLogin}`,{
                email: formData.email,
                password: formData.password
            });
            if (response.status === 200){
                token.value = response.data.token;
                if (response.data.token) {
                    localStorage.setItem('token',response.data.token);
                    const router = useRouter();
                    await router.push({ path: "/articles" });
                }
            }
        } catch (error) {
            console.log(error);
        }
    }

    const logout = async () => {
        if (!token.value) return;
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
        showLoginPage,
        loginAction,
        formData,
        closeModalOutside,
        token,
        logout,
        getLocalStorageToken,
        acceptAction,
        acceptWindowShow,
        updateFormDataFromRegister
    };
})