<template>
  <component :is="layoutComponent">
    <router-view />
  </component>
</template>

<script setup>
import { computed, watch } from "vue";
import DefaultLayout from "@/layouts/DefaultLayout.vue";
import AdminLayout from "@/layouts/AdminLayout.vue";
import { useLayoutStore } from "./stores/layout.js";
import { useRoute } from "vue-router";
import { storeToRefs } from "pinia";

const layoutStore = useLayoutStore();
const route = useRoute();
const { layout } = storeToRefs(layoutStore);
const layoutComponent = computed(() => {
  if (layout.value === "admin" && route.path.startsWith("/admin")) {
    return AdminLayout;
  }
  return DefaultLayout;
});
watch(layout.value, (newLayout) => {
  console.log(newLayout);
  layoutStore.switchLayout(newLayout);
});
</script>

<style lang="scss"></style>
