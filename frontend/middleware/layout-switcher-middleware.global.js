export default defineNuxtRouteMiddleware(async (to) => {
    const isAdminRoute = to.fullPath.startsWith('/admin');
    onNuxtReady( async () => {
        const { useUserRoleStore } = await import('~/stores/userRole.js')
        const { useLayoutStore } = await import('~/stores/layout.js')
        const { useLoginStore } = await import('~/stores/login.js')
        const userRoleStore =  useUserRoleStore();
        const layoutStore =  useLayoutStore();
        const loginStore = useLoginStore();

        const userRole = sessionStorage.getItem('userRole') || userRoleStore.getUserRole();
        console.log(userRole)
        if (isAdminRoute && userRole === 'admin') {
            layoutStore.switchLayout('admin');
        }
        if (isAdminRoute && userRole !== 'admin') {
            loginStore.showLoginPage();
            // return navigateTo('/register');
        }
    })
})