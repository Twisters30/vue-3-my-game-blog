<template>
  <Loader />
  <NuxtLayout >
    <NuxtPage :name="'default'"/>
  </NuxtLayout >
</template>

<script setup>
import { useLayoutStore } from "@/stores/layout.js";
import { useUserRoleStore } from "./stores/userRole.js";
import { useRefreshUser } from "~/stores/refreshUser.js";

const layoutStore = useLayoutStore();
const userRoleStore = useUserRoleStore();
const refreshUser = useRefreshUser();

onMounted(() => {
  if (userRoleStore.userRole === 'guest') {
    refreshUser.refresh();
  };
});
</script>