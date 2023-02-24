import { defineStore } from "pinia";
import axios from "axios";
import { useUserRoleStore } from "~/stores/userRole.js";
import { apiHost, apiLogin, apiLogout} from "~/config/api.js";


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
                if (response.data.accessToken) {
                    sessionStorage.setItem('token',JSON.stringify(token));
                    const router = useRouter();
                    await router.push({ path: "/articles" });
                    userRoleStore.setUserRole(response.data.role);
                    if (response.data.role.toLocaleLowerCase() === 'admin' || response.data.role.toLocaleLowerCase() === 'author') {
                        await router.push({ path: "/admin/dashboard" });
                    }

                }
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
    };
})