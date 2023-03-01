import { defineStore } from "pinia";
import { useLoginStore } from "~/stores/login";
import axios from "axios";
import { apiHost, apiRefreshToken } from "~/config/api.js";

export const useAxiosStore = defineStore('axiosStore', () => {
    const loginStore = useLoginStore();

    const setConfigAxios = () => {
        const tokenRefresh = loginStore.getRefreshToken();
        const tokenAccess = loginStore.getAccessToken();

        const refreshToken = async () => {
            const {useLoginStore} = await import("~/stores/login");
            const loginStore = useLoginStore();
            console.log(loginStore.getRefreshToken(), 'Токен из метода refreshToken')
            return await axios.get(`${apiHost}/${apiRefreshToken}`,{
                headers: {'Authorization': `Bearer ${ loginStore.getRefreshToken() }`}
            });
        }
        const axiosInstance = axios.create({
            headers: {  Authorization: `Bearer ${ tokenAccess }`}
        });

        axiosInstance.interceptors.request.use(
            async config => {
                if (tokenAccess) {
                    config.headers.Authorization = `Bearer ${ tokenAccess }`;
                }
                return config;
            },
            error => {
                return Promise.reject(error);
            }
        );

        axiosInstance.interceptors.response.use(
            response => {
                return response;
            },
            async error => {
                const originalRequest = error.config;
                if (error.response.status === 403 && !originalRequest._retry) {
                    originalRequest._retry = true;
                    try {
                        const newToken = await refreshToken();
                        loginStore.setStorageToken(newToken.data);
                        console.log(newToken.data.accessToken)
                        originalRequest.headers.Authorization = `Bearer ${newToken.data.accessToken}`;
                        return axiosInstance(originalRequest);
                    } catch (error) {
                        console.log(error);
                        loginStore.logout();
                        const router = useRouter();
                        await router.push('/');
                        loginStore.showLoginPage();
                    }
                }
                return Promise.reject(error);
            }
        );
        return axiosInstance;
    }

    return { setConfigAxios };
})