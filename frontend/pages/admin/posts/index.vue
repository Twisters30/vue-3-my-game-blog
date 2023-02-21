<template>
<div>admin/posts</div>
</template>

<script setup>
import { useAdminStore } from "@/stores/admin/posts.js";
const adminStore = useAdminStore();
adminStore.getPosts()

</script>

<style scoped>

</style>