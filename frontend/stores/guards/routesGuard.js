import { defineStore } from "pinia";
import { useLayoutStore } from "@/stores/layout.js";
import { useUserRoleStore } from "@/stores/userRole.js";

export const useRoutesGuard = defineStore('routesGuard', () => {
    const layoutStore = useLayoutStore();
    const userRoleStore = useUserRoleStore();
    const router = useRouter();
    const route = useRoute();
    const role = userRoleStore.userRole.toLowerCase();

    const useGuard = (to) => {

    }
    return { useGuard }
})