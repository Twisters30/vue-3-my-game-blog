<template>
  <Loader />
  <NuxtLayout :name="layoutStore.layout">
    <NuxtPage />
  </NuxtLayout >
</template>

<script setup>
import { useLayoutStore } from "@/stores/layout.js";
import { useUserRoleStore } from "./stores/userRole.js";

const layoutStore = useLayoutStore();
const userRoleStore = useUserRoleStore();
</script>

<style></style>