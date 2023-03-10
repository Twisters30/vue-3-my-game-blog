<template>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center">
          <div class="row col-md-6">
            <admin-base-form
              :post="post"
              :post-statuses="statuses"
              @create-or-update-post="adminPostsStore.createOrUpdatePost"
            />
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useRoute } from "vue-router";
import { useAdminPostsStore } from "@/stores/admin/posts.js";
import AdminBaseForm from "../../../components/backend/forms/AdminBaseForm.vue";

const adminPostsStore = useAdminPostsStore();
const route = useRoute();
const post = await adminPostsStore.getByPostId(route.params.id);
const statuses = ref(await adminPostsStore.getPostStatuses());
</script>

<style scoped></style>
