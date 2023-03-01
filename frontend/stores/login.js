import { defineStore } from "pinia";
import axios from "axios";
import { useUserRoleStore } from "~/stores/userRole.js";
import {apiHost, apiLogin, apiLogout, apiRefreshToken} from "~/config/api.js";
import { useAxiosStore } from "~/stores/axiosInstance.js";
import { useLayoutStore } from "~/stores/layout.js";


export const useLoginStore = defineStore('LoginStore', () => {
    const userRoleStore = useUserRoleStore();
    const isLoginPageShow = ref(false);
    const layoutStore = useLayoutStore();
    const formData = reactive({});
    let isUserDataLoading = ref(true);
    let token = reactive({
        refreshToken:false,
        accessToken:false
    });
    const acceptWindowShow = ref(false);

    const updateFormDataFromRegister = ({email, password}) => {
        formData.email = email;
        formData.password = password;
    }

    const acceptAction = async (userAnswer) => {
        if (userAnswer === true) {
           await logout();
        }
        acceptWindowShow.value = !acceptWindowShow.value;
    }

    const getStorageToken = () => {
        const { accessToken, refreshToken } = JSON.parse(sessionStorage.getItem('token')) || false;
        token.accessToken = accessToken;
        token.refreshToken = refreshToken;
        isUserDataLoading.value = false;
        return accessToken;
    }

    const getRefreshToken = () => token.refreshToken;
    const getAccessToken = () => token.accessToken;

    const showLoginPage = () => isLoginPageShow.value = !isLoginPageShow.value;

    const closeModalOutside = (event) => {
        if (event.target.id === 'modal-overlay') {
            showLoginPage();
        }
    }

    const removeDataUserStore = () => {
        token.accessToken = false;
        token.refreshToken = false;
        sessionStorage.removeItem('token');
        userRoleStore.removeUserRole();
    }

    const setStorageToken = (token) => {
        sessionStorage.setItem('token',JSON.stringify(token));
    }

    const loginAction = async (valueForm) => {
        try {
            const response = await axios.post(`${apiHost}/${apiLogin}`,{
                email: formData.email,
                password: formData.password
            });
            if (response.status === 200){
                showLoginPage();
                token.accessToken = response.data.accessToken;
                token.refreshToken = response.data.refreshToken;
                sessionStorage.setItem('token',JSON.stringify(token));
                const router = useRouter();
                const userRole = response.data.role.toLocaleLowerCase()
                userRoleStore.setUserRole(response.data.role);
                if (userRole === 'admin' || userRole === 'author') {
                    await router.push({ path: "/admin/dashboard" });
                    return;
                }
                await router.push({ path: "/articles" });
            }
        } catch (error) {
            console.log(error);
        }
    }

    const logout = async () => {
        if (!token.accessToken) return;
        try {
            const response = await axios.post(`${apiHost}/${apiLogout}`,{},
                {
                    headers: {'Authorization': `Bearer ${token.refreshToken}`}
                }
            )
            if (response.status === 200) {
                removeDataUserStore();
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
        getStorageToken,
        acceptAction,
        acceptWindowShow,
        updateFormDataFromRegister,
        isUserDataLoading,
        setStorageToken,
        getRefreshToken,
        getAccessToken
    };
})