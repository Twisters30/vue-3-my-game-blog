import { defineStore } from "pinia";

export const useUserRoleStore = defineStore('userRole', () => {
    const userRole = ref('guest');

    const setUserRole = (role) => {
        userRole.value = role.toLowerCase();
        setUserRoleStorage(userRole.value);
    };
    const getUserRole = () => userRole.value;
    const setUserRoleStorage = (role) => {
        sessionStorage.setItem('userRole',role);
    }

    const getUserRoleStorage = () => {
        const userRoleInStorage = sessionStorage.getItem('userRole') || getUserRole();
        userRole.value = userRoleInStorage;
        return userRoleInStorage
    }
    const removeUserRole = () => {
        userRole.value = null;
        sessionStorage.removeItem('userRole');
    }

    return { userRole, setUserRole, getUserRole, setUserRoleStorage, getUserRoleStorage, removeUserRole };
})