import { defineStore } from "pinia";
import { useLoginStore } from "~/stores/login";
import axios from "axios";
import { useRefreshUserStore } from "~/stores/refreshUser.js";
import { useRouter } from "vue-router";

export const useAxiosStore = defineStore("axiosStore", () => {
  const loginStore = useLoginStore();
  const refreshUserStore = useRefreshUserStore();
  const setConfigAxios = () => {
    let axiosInstance;
    axiosInstance = axios.create();

    // axiosInstance.interceptors.request.use(
    //     async config => {
    //         if (tokenAccess) {
    //         }
    //         return config;
    //     },
    //     error => {
    //         return Promise.reject(error);
    //     }
    // );

    axiosInstance.interceptors.response.use(
      (response) => {
        return response;
      },
      async (error) => {
        const originalRequest = error.config;
        if (error.response.status === 403 && !originalRequest._retry) {
          originalRequest._retry = true;
          try {
            const newToken = await refreshUserStore.refresh();
            originalRequest.headers.Authorization = `Bearer ${newToken.accessToken}`;
            console.log(axiosInstance(originalRequest));
            return axiosInstance(originalRequest);
          } catch (error) {
            console.log(error);
            await loginStore.logout();
            const router = useRouter();
            await router.push("/");
            loginStore.showLoginPage();
          }
        }
        return Promise.reject(error);
      }
    );
    return axiosInstance;
  };

  return { setConfigAxios };
});
