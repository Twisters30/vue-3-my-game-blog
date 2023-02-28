<template>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
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
const  adminPostsStore = useAdminPostsStore();
const route = useRoute();
const post = adminPostsStore.getByPostId(route.params.id);
const test = '123'

</script>

<style scoped>

</style>