
import { useLayoutStore } from "~/stores/layout.js";
import { useLoginStore } from "~/stores/login.js";
import { useAdminStore } from "@/stores/admin/posts.js";

export default defineNuxtRouteMiddleware(async (to) => {
    const adminStore = useAdminStore();
    const userRole = await adminStore.getPosts()
    const isAdminRoute = to.fullPath.startsWith('/admin');
    const loginStore = useLoginStore();
    let isAdminRole = loginStore.getRole();
    const layoutStore = useLayoutStore();
    if (isAdminRoute && userRole === 'admin') {
        layoutStore.switchLayout('admin');
    }
})