<template>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="row col-md-6">
            <AdminBaseForm
                :post="adminPostsStore.createFormData"
                :createFormData="adminPostsStore.createFormData"
                :postStatuses="postStatuses"
                @create-post="adminPostsStore.createPost"
            />
          </div>
        </div>
        <div class="row mb-2">
          <section class="content">
            <div class="row">
              <div class="col-md-12">
                <div class="card card-outline card-info">
                  <div class="card-header">
                    <h3 class="card-title">
                      Summernote
                    </h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-footer">
                    Visit <a href="https://github.com/summernote/summernote/">Summernote</a> documentation for more examples and information about the plugin.
                  </div>
                </div>
              </div>
              <!-- /.col-->
            </div>
          </section>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import AdminBaseForm from "@/components/backend/forms/AdminBaseForm.vue";
import { useAdminPostsStore } from "@/stores/admin/posts.js";

const postStatuses = ref(null);
const adminPostsStore = useAdminPostsStore();
const post = reactive({});
onMounted(async () => {
  postStatuses.value = await adminPostsStore.getPostStatuses();
  console.log(postStatuses)
})
</script>

<style scoped>

</style>