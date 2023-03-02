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
              :tableHeaders="adminPostsStore.tableHeaders"
              :tableTitle="adminPostsStore.tableTitle"
              :tableContent="adminPostsStore.posts"
              :pathUrl="adminPostsStore.pathUrl"
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
import { useAdminPostsStore } from "@/stores/admin/posts.js";
import { useRoutesGuard } from "@/stores/guards/routesGuard.js";
const routesGuard = useRoutesGuard();
const  adminPostsStore = useAdminPostsStore();
routesGuard.useGuard();
onMounted(() => {
  adminPostsStore.getPosts();
})
definePageMeta({
  layout: 'admin'
})
</script>



<style scoped>

</style>