<template>
  <Loader />
  <NuxtLayout >
    <NuxtPage />
  </NuxtLayout >
</template>

<script setup>
import { useLayoutStore } from "@/stores/layout.js";
import { useUserRoleStore } from "./stores/userRole.js";
import { useRefreshUserStore } from "~/stores/refreshUser.js";
import { useAdminPostsStore } from "./stores/admin/posts.js";

const layoutStore = useLayoutStore();
const userRoleStore = useUserRoleStore();
const refreshUser = useRefreshUserStore();
const adminPostsStore = useAdminPostsStore();
onBeforeMount(() => {
  if (userRoleStore.userRole === 'guest') {
    refreshUser.refresh();
  }
});
</script>