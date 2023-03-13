<template>
  <loader
    v-if="!layoutComponent"
    class="main-loader"
    width="150px"
    height="100px"
  />
  <component v-else :is="layoutComponent">
    <suspense>
      <router-view />
    </suspense>
  </component>
</template>

<script setup>
import { computed, onBeforeMount, defineAsyncComponent } from "vue";
import { useLayoutStore } from "@/stores/layout.js";
import { useRefreshUserStore } from "@/stores/refreshUser.js";
import { useUserRoleStore } from "@/stores/userRole.js";
import { storeToRefs } from "pinia";
import Loader from "./components/Loader.vue";
const DefaultLayout = defineAsyncComponent(() => {
  return import("./layouts/DefaultLayout.vue");
});
const AdminLayout = defineAsyncComponent(() => {
  return import("@/layouts/AdminLayout.vue");
});
const layoutStore = useLayoutStore();
const refreshUser = useRefreshUserStore();
const userRoleStore = useUserRoleStore();
const { layout } = storeToRefs(layoutStore);
const layoutComponent = computed(() => {
  if (layout.value === "admin") {
    return AdminLayout;
  }
  return DefaultLayout;
});
onBeforeMount(() => {
  if (userRoleStore.userRole === "guest") {
    refreshUser.refresh();
  }
});
</script>
