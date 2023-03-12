import { defineStore } from "pinia";
import axios from "axios";
import { useUserRoleStore } from "@/stores/userRole.js";
import { apiHost, apiLogin, apiLogout } from "@/config/api.js";
import { ref, reactive } from "vue";

export const useLoginStore = defineStore("LoginStore", () => {
  const userRoleStore = useUserRoleStore();
  const isLoginPageShown = ref(false);
  const formData = reactive({});
  let userDataLoading = ref(true);
  let token = reactive({
    refreshToken: false,
    accessToken: false,
  });
  const acceptWindowShow = ref(false);

  const updateFormDataFromRegister = ({ email, password }) => {
    formData.email = email;
    formData.password = password;
  };

  const disableLoader = () => {
    userDataLoading.value = false;
  };

  const acceptAction = async (userAnswer) => {
    if (userAnswer === true) {
      console.log(userAnswer);
      await logout();
    }
    acceptWindowShow.value = !acceptWindowShow.value;
  };

  const getRefreshTokenStorage = () => {
    return JSON.parse(sessionStorage.getItem("token"))?.refreshToken || false;
  };
  const getAccessTokenStorage = () => {
    return JSON.parse(sessionStorage.getItem("token"))?.accessToken || false;
  };

  const getRefreshToken = () => token.refreshToken;
  const getAccessToken = () => token.accessToken;

  const showLoginPage = () => {
    isLoginPageShown.value = !isLoginPageShown.value;
  };

  const closeModalOutside = (event) => {
    if (event.target.id === "modal-overlay") {
      showLoginPage();
    }
  };

  const removeDataUserStore = () => {
    token.accessToken = false;
    token.refreshToken = false;
    sessionStorage.removeItem("token");
    userRoleStore.removeUserRole();
  };

  const setStorageToken = (token) => {
    sessionStorage.setItem("token", JSON.stringify(token));
  };

  const setStateToken = (newToken) => {
    token.accessToken = newToken.accessToken;
    token.refreshToken = newToken.refreshToken;
  };

  const loginAction = async () => {
    try {
      const response = await axios.post(`${apiHost}/${apiLogin}`, {
        email: formData.email,
        password: formData.password,
      });
      if (response.status === 200) {
        showLoginPage();
        token.accessToken = response.data.accessToken;
        token.refreshToken = response.data.refreshToken;
        setStorageToken(token);
        const userRole = response.data.role.toLocaleLowerCase();
        userRoleStore.setUserRole(response.data.role);
        return userRole;
      }
    } catch (error) {
      console.log(error);
    }
  };

  const logout = async () => {
    const token = getAccessTokenStorage();
    if (!token) return;
    try {
      const response = await axios.post(
        `${apiHost}/${apiLogout}`,
        {},
        {
          headers: { Authorization: `Bearer ${token}` },
        }
      );
      if (response.status === 200) {
        removeDataUserStore();
        userRoleStore.removeUserRole();
        isLoginPageShown.value = false;
      }
    } catch (error) {
      console.log(error);
    }
  };

  return {
    isLoginPageShown,
    showLoginPage,
    loginAction,
    formData,
    closeModalOutside,
    token,
    logout,
    acceptAction,
    acceptWindowShow,
    updateFormDataFromRegister,
    userDataLoading,
    setStorageToken,
    getRefreshToken,
    getAccessToken,
    getAccessTokenStorage,
    getRefreshTokenStorage,
    setStateToken,
    disableLoader,
  };
});
