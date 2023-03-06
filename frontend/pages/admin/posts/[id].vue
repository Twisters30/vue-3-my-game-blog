<template>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center">
          <div class="row col-md-6">
            <AdminBaseForm :post="post" />
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import Editor from '@/components/Editor.vue';
import { useAdminPostsStore } from "@/stores/admin/posts.js";
import AdminBaseForm from "@/components/backend/forms/AdminBaseForm.vue";
import { useRoutesGuard } from "@/stores/guards/routesGuard.js";
const  adminPostsStore = useAdminPostsStore();
const route = useRoute();
const post = await adminPostsStore.getByPostId(route.params.id);
console.log(post)
definePageMeta({
  layout: 'admin'
})
</script>

<style scoped>

</style>