<template>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ props.title }}</h1>
        </div>
        <div class="col-sm-6" v-if="breadcrumb">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><NuxtLink to="/admin/dashboard">Dashboard</NuxtLink></li>
            <li class="breadcrumb-item active"><NuxtLink to="/admin/posts">Posts</NuxtLink></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
</template>

<script setup>
const props = defineProps({
  title: {
    default: 'Title page',
    type: String,
  },
  breadcrumb: {
    default: true,
    type: Boolean,
  }
});
</script>

<style scoped>

</style>