import { defineStore } from "pinia";
import axios from "axios";
import { apiHost, apiRegister } from "~/config/api";
import { useLoginStore } from "~/stores/login.js";
import { reactive } from "vue";

export const useRegisterStore = defineStore("registerStore", () => {
  const formData = reactive({});
  const loginStore = useLoginStore();
  const registerAction = async () => {
    try {
      const response = await axios.post(`${apiHost}/${apiRegister}`, {
        name: formData.name,
        email: formData.email,
        password: formData.password,
      });
      if (response.status === 200) {
        loginStore.showLoginPage();
        loginStore.updateFormDataFromRegister({
          email: formData.email,
          password: formData.password,
        });
      }
      console.log(formData, "fromPiniaStore");
    } catch (error) {
      console.log(error);
    }
  };

  return { registerAction, formData };
});
