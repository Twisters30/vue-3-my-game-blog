<template>
  <div>
    <h1 class="main-title">Articles</h1>
    <div class="post__feed">
      <Post :post="post" v-for="post in posts" :key="post.id" />
    </div>
  </div>
</template>

<script setup>
import Post from "../components/frontend/Post.vue";
import { usePostsStore } from "~/stores/posts.js";

const postStore = usePostsStore();

const posts = await postStore.getPosts();
</script>

<style lang="scss">
.post {
  &__feed {
    padding: 0 50px;
  }
}
</style>
