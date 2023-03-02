<template>
    <div>
        <h1 class="main-title">Main</h1>
    </div>
</template>

<script setup>
import { useRoutesGuard } from "@/stores/guards/routesGuard.js";
onMounted(() => {
  const routesGuard = useRoutesGuard();
  routesGuard.useGuard();
})
definePageMeta({
  layout: 'default'
})
</script>