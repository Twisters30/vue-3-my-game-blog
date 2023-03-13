<template>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="my-4">
          <router-link to="/admin/posts/create" class="btn btn-success">
            Создать
          </router-link>
        </div>
        <div class="row mb-2">
          <base-table
            @delete-post="adminPostsStore.deletePost"
            @change-status="adminPostsStore.changeStatus"
            :table-headers="adminPostsStore.tableHeaders"
            :table-content="posts"
            :post-statuses="statuses"
          />
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import BaseTable from "../../../components/BaseTable.vue";
import { useAdminPostsStore } from "@/stores/admin/posts.js";
import { storeToRefs } from "pinia";
const adminPostsStore = useAdminPostsStore();
await adminPostsStore.getPosts();
const { posts } = storeToRefs(adminPostsStore);
const statuses = await adminPostsStore.getPostStatuses();
</script>

<style scoped></style>
