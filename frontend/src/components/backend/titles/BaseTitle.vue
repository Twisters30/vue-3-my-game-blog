<template>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ props.title }}</h1>
        </div>
        <div class="col-sm-6" v-if="breadcrumb">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <router-link to="/admin/dashboard">Dashboard</router-link>
            </li>
            <li class="breadcrumb-item active">
              <router-link to="/admin/posts">Posts</router-link>
            </li>
          </ol>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>
</template>

<script setup>
import { defineProps } from "vue";
const props = defineProps({
  title: {
    default: "Title page",
    type: String,
  },
  breadcrumb: {
    default: true,
    type: Boolean,
  },
});
</script>

<style scoped></style>
