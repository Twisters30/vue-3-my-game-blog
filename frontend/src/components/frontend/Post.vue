<template>
  <div class="post__wrapper line">
    <h3 class="post__title sub-title">
      {{ post.name }}
    </h3>
    <div class="post__left">
      <img class="post__image" :src="image" alt="Изображение статьи" />
      <p v-html="post.description" class="post__text-preview cut-text"></p>
    </div>
    <div class="post__footer-wrapper">
      <div class="post__footer">
        <span class="post__author">{{ post.author_name }}</span>
        <span class="post__separator">|</span>
        <span class="post__date">{{ post.created_at }}</span>
      </div>
    </div>
  </div>
</template>
<script setup>
import { defineProps } from "vue";
const props = defineProps(["post"]);
const image = "http://localhost/" + props.post.image;
</script>
<style lang="scss" scoped></style>
