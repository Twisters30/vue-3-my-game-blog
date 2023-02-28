<template>
  <Loader />
  <NuxtLayout :name="layoutStore.layout">
    <NuxtPage />
  </NuxtLayout >
</template>

<script setup>
import { useLayoutStore } from "@/stores/layout.js";
import { useUserRoleStore } from "./stores/userRole.js";
import axios from "axios";

const layoutStore = useLayoutStore();
const userRoleStore = useUserRoleStore();
axios.interceptors.request.use((res) => {
  console.log(res)
  return res;
},  (error) => {
  console.log(error);
  return Promise.reject(error);
});
</script>

<style></style>