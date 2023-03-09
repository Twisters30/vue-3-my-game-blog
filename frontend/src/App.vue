<template>
  <component :is="layout">
    <router-view />
  </component>
</template>

<script setup>
import { computed } from "vue";
import DefaultLayout from "@/layouts/DefaultLayout.vue";
// import AdminLayout from "@/layouts/AdminLayout.vue";

// let isLayout = "default";

const layout = computed(() => {
  return DefaultLayout;
  // return AdminLayout;
});
</script>

<style lang="scss"></style>
