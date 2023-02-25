<template>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="row col-md-6">
            <AdminBaseForm :post="null" :postStatuses="postStatuses "/>
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
                  <div class="card-body">
                    <Editor v-model:content="content" />
                  </div>
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
const postStatuses = ref([1,2,3]);
const content = ref('Введите текст');
</script>

<style scoped>

</style>