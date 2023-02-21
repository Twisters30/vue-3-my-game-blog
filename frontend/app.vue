<template>
  <Loader />
  <NuxtLayout :name="layoutStore.layout">
    <NuxtPage />
  </NuxtLayout >
</template>

<script setup>
import { useLayoutStore } from "@/stores/layout.js";

const layoutStore = useLayoutStore();

</script>

<style></style>