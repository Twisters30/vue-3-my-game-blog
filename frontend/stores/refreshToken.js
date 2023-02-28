import { defineStore } from "pinia";
import { useLoginStore } from "~/stores/login";
import axios from "axios";
import { IAuthTokens, TokenRefreshRequest, applyAuthTokenInterceptor, getBrowserLocalStorage } from 'axios-jwt'
import { apiHost, apiLogin, apiLogout , apiRefreshToken } from "~/config/api.js";

export const useRefreshToken = defineStore('refreshToken', () => {
    const loginStore = useLoginStore();
    // 1. Create an axios instance that you wish to apply the interceptor to
    const axiosInstance = axios.create({ baseURL: `${apiHost}/${apiLogin}` })

// 2. Define token refresh function.
    const requestRefresh = (refresh) => {
        // Notice that this is the global axios instance, not the axiosInstance!  <-- important
        return axios.post(`${apiHost}/${apiRefreshToken}`, { refresh })
            .then(response => resolve(response.data.access_token))
    };

// 3. Apply interceptor
    applyAuthTokenInterceptor(axiosInstance, { requestRefresh });  // Notice that this uses the axiosInstance instance.  <-- important

// 4. Logging in
    const login = async (params) => {
        const response = await axiosInstance.post('/auth/login', {

        })

        // save tokens to storage
        setAuthTokens({
            accessToken: response.data.access_token,
            refreshToken: response.data.refresh_token
        })
    }

// 5. Logging out
    const logout = () => clearAuthTokens()

// Now just make all requests using your axiosInstance instance
    axiosInstance.get('/api/endpoint/that/requires/login').then(response => { })
})