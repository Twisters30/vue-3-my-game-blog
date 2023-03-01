export default defineNuxtRouteMiddleware(async (to) => {
    const isAdminRoute = to.fullPath.startsWith('/admin');
    const { useUserRoleStore } = await import('~/stores/userRole.js')
    const { useLayoutStore } = await import('~/stores/layout.js')
    const userRoleStore =  useUserRoleStore();
    const layoutStore =  useLayoutStore();
    // if (layoutStore.layout === 'admin') return
    const userRole = userRoleStore.getUserRole();
    console.log(userRole)
    // const userRoleState = useState('userRole');
    if (isAdminRoute && userRole === 'admin') {
        layoutStore.switchLayout('admin');
        console.log('админ мидлвар')
    }
    if (isAdminRoute && userRole === 'guest') {
        layoutStore.switchLayout('default');
        const router = useRouter();
        router.push('/')
        console.log('guest мидлвар')
    }
})