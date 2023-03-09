import { defineStore } from "pinia";
// import { useLocalStorage,  } from '@vueuse/core'
import { ref } from "vue";
export const useUserRoleStore = defineStore("userRole", () => {
  const userRole = ref("guest");

  const setUserRole = (role) => {
    userRole.value = role.toLowerCase();
  };
  const getUserRole = () => userRole.value;

  const removeUserRole = () => {
    userRole.value = null;
    localStorage.removeItem("userRole");
  };

  return { userRole, setUserRole, getUserRole, removeUserRole };
});
