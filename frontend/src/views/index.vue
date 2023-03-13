<template>
  <div>
    <h1 class="main-title">Articles</h1>
    <div class="post__feed">
      <post
        @click="$router.push('/post/' + post.id)"
        :post="post"
        v-for="post in posts"
        :key="post.id"
      />
    </div>
  </div>
</template>

<script setup>
import Post from "../components/frontend/Post.vue";
import { usePostsStore } from "~/stores/posts.js";
const postStore = usePostsStore();
const posts = await postStore.getPosts();
console.log(posts);
</script>

<style lang="scss"></style>
