
import { useLayoutStore } from "~/stores/layout.js";
import { useLoginStore } from "~/stores/login.js";

export default defineNuxtRouteMiddleware((to) => {
    const isAdminRoute = to.fullPath.startsWith('/admin');
    const loginStore = useLoginStore();
    let isAdminRole = loginStore.getRole();
    const layoutStore = useLayoutStore();
    console.log(loginStore.getRole(), 'userRole')
    if (isAdminRoute && isAdminRole === 'Admin') {
        layoutStore.switchLayout('admin');
    }
})