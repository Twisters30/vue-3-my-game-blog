import {defineStore} from "pinia";
import axios from "axios";
import { apiHost, apiRefreshToken } from "~/config/api.js";
import { useLoginStore } from "~/stores/login.js";
import { useUserRoleStore } from "~/stores/userRole.js";

export const useRefreshUserStore = defineStore('refreshUser', () => {
    const loginStore = useLoginStore();
    const userRoleStore = useUserRoleStore();
    const refresh = async () => {

        if (!loginStore.getRefreshTokenStorage()) {
            return
        };

        try {
            const response = await axios.get(`${apiHost}/${apiRefreshToken}`, {
                headers: {
                    'Authorization': `Bearer ${loginStore.getRefreshTokenStorage()}`
                }
            });

            if (response.status === 200) {
                const responseToken = {
                    accessToken: response.data.accessToken,
                    refreshToken: response.data.refreshToken
                };
                loginStore.disableLoader();
                loginStore.setStorageToken(responseToken);
                loginStore.setStateToken(responseToken);
                userRoleStore.setUserRole(response.data.role);
                return responseToken;
            }
        } catch (error) {
            console.log(error);
        };
    };

    return {
        refresh
    };
});