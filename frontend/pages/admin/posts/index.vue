<template>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="my-4">
          <NuxtLink to="/admin/posts/create" class="btn btn-success">Создать</NuxtLink>
        </div>
        <div class="row mb-2">
          <BaseTable
              @change-post-status="adminPostsStore.changePostStatus"
              @delete-post="adminPostsStore.deletePost"
              :tableHeaders="adminPostsStore.tableHeaders"
              :tableTitle="adminPostsStore.tableTitle"
              :tableContent="posts"
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
import BaseTable  from "@/components/BaseTable.vue";
import { useAdminPostsStore} from "@/stores/admin/posts.js";
import { storeToRefs } from 'pinia'
const adminPostsStore = useAdminPostsStore();
await adminPostsStore.getPosts();
const state = storeToRefs(adminPostsStore);
const posts = state.posts;
let statuses = ref();
definePageMeta({
  layout: 'admin'
})

onBeforeMount(async () => {
  statuses.value = await adminPostsStore.getPostStatuses()
})
</script>


<style scoped>

</style>