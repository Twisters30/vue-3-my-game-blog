import { defineStore } from "pinia";
import axios from "axios";
import { useUserRoleStore } from "~/stores/userRole.js";
import { apiHost, apiLogin, apiLogout } from "~/config/api.js";


export const useLoginStore = defineStore('LoginStore', () => {
    const userRoleStore = useUserRoleStore();
    const isLoginPageShow = ref(false);
    const formData = reactive({});
    let isUserDataLoading = ref(true);
    let token = reactive({
        refreshToken:false,
        accessToken:false
    });
    const acceptWindowShow = ref(false);

    const updateFormDataFromRegister = ({ email, password }) => {
        formData.email = email;
        formData.password = password;
    }

    const disableLoader = () => {
        isUserDataLoading.value = false;
    }

    const acceptAction = async (userAnswer) => {
        if (userAnswer === true) {
           await logout();
        }
        acceptWindowShow.value = !acceptWindowShow.value;
    }

    const getRefreshTokenStorage = () => {
        return JSON.parse(sessionStorage.getItem('token'))?.refreshToken || false;
    };
    const getAccessTokenStorage = () => {
        return JSON.parse(sessionStorage.getItem('token'))?.accessToken || false;
    };

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

    const setStateToken = (newToken) => {
        token.accessToken = newToken.accessToken;
        token.refreshToken = newToken.refreshToken;
    };

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
                setStorageToken(token);
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
                userRoleStore.removeUserRole();
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
        acceptAction,
        acceptWindowShow,
        updateFormDataFromRegister,
        isUserDataLoading,
        setStorageToken,
        getRefreshToken,
        getAccessToken,
        getAccessTokenStorage,
        getRefreshTokenStorage,
        setStateToken,
        disableLoader
    };
})