<template>
  <component :is="layoutComponent">
    <suspense>
      <router-view />
    </suspense>
  </component>
</template>

<script setup>
import { computed } from "vue";
import DefaultLayout from "@/layouts/DefaultLayout.vue";
import AdminLayout from "@/layouts/AdminLayout.vue";
import { useLayoutStore } from "./stores/layout.js";
import { storeToRefs } from "pinia";

const layoutStore = useLayoutStore();
const { layout } = storeToRefs(layoutStore);
const layoutComponent = computed(() => {
  if (layout.value === "admin") {
    return AdminLayout;
  }
  return DefaultLayout;
});
</script>

<style lang="scss"></style>
