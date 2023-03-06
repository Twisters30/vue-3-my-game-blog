<template>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center">
          <div class="col-md-6 col-sm-12">
            <BaseTitle />
            <admin-base-form
                :post="adminPostsStore.createFormData"
                :createFormData="adminPostsStore.createFormData"
                :postStatuses="postStatuses"
                @create-post="adminPostsStore.createPost"
            />
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import AdminBaseForm from "@/components/backend/forms/AdminBaseForm.vue";
import { useAdminPostsStore } from "@/stores/admin/posts.js";
import BaseTitle from "@/components/backend/titles/BaseTitle.vue";
import { useRoutesGuard } from "@/stores/guards/routesGuard.js";
const postStatuses = ref(null);
const adminPostsStore = useAdminPostsStore();
const post = reactive({});
onMounted(async () => {
  postStatuses.value = await adminPostsStore.getPostStatuses();
  console.log(postStatuses)
})
definePageMeta({
  layout: 'admin'
})
</script>

<style scoped>

</style>