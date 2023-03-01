<template>
  <Loader />
  <NuxtLayout :name="layoutStore.layout">
    <NuxtPage />
  </NuxtLayout >
</template>

<script>
  export default {}
</script>

<script setup>
import { useLayoutStore } from "@/stores/layout.js";
import { useUserRoleStore } from "./stores/userRole.js";

const layoutStore = useLayoutStore();
const userRoleStore = useUserRoleStore();
const userRole = userRoleStore.getUserRoleStorage()

onBeforeMount(() => {
  const route = useRoute();
  console.log(userRole, 'app')
  if (userRole === 'admin' && route.path.startsWith('/admin')) {
    layoutStore.switchLayout('admin');
  }



  // userRoleStore.getUserRoleStorage();
  // watch(() => userRoleStore.userRole, (value) => {
  //   userRoleStore.getUserRoleStorage()
  //   useState('userRole',() => value);
  //   const a = () => inject(value)
  //   if (value === 'admin' && route.path.startsWith('/admin')) {
  //     layoutStore.switchLayout(value);
  //   }
  // },{immediate: true})
})
</script>

<style></style>