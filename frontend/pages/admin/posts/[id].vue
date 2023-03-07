<template>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center">
          <div class="row col-md-6">
            <AdminBaseForm :post="post" :post-statuses="statuses"/>
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
const post = await adminPostsStore.getByPostId(route.params.id);
const statuses = ref();
definePageMeta({
  layout: 'admin'
})

onMounted(async () => {
  statuses.value = await adminPostsStore.getPostStatuses();
})
</script>

<style scoped>

</style>