import { useRoutesGuard } from "@/stores/guards/routesGuard.js";
import { useUserRoleStore } from "~/stores/userRole.js";

export default defineNuxtRouteMiddleware((to, from) => {
    const router = useRouter();
    const userRoleStore = useUserRoleStore();
})
