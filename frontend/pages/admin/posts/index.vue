<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="my-4">
          <NuxtLink to="/admin/posts/create" class="btn btn-success">Создать</NuxtLink>
        </div>
        <div class="row mb-2">
          <BaseTable
              @delete-post="adminPostsStore.deletePost"
              :tableHeaders="adminPostsStore.tableHeaders"
              :tableTitle="adminPostsStore.tableTitle"
              :tableContent="posts"
              :pathUrl="adminPostsStore.pathUrl"
              :post-statuses="postStatuses"
          />
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

    <!-- /.content -->
  </div>
</template>

<script setup>
import BaseTable  from "@/components/BaseTable.vue";
import { useAdminPostsStore} from "@/stores/admin/posts.js";
import { storeToRefs } from 'Pinia';
const adminPostsStore = useAdminPostsStore();
const postStatuses = await adminPostsStore.getPostStatuses();
await adminPostsStore.getPosts();
const state = storeToRefs(adminPostsStore);
const posts = state.posts;
console.log(state)
console.log(isRef(state.posts.value))
definePageMeta({
  layout: 'admin'
})
</script>



<style scoped>

</style>