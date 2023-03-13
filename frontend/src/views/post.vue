<template>
  <div class="post__wrapper">
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
import { useRoute } from "vue-router";
import { computed } from "vue";
import { usePostsStore } from "@/stores/posts.js";
const route = useRoute();
const postsStore = usePostsStore();
const post = await postsStore.getActivePostById(route.params.id);
const image = computed(
  () =>
    "https://img1.akspic.ru/previews/2/3/2/8/6/168232/168232-battlefield_2042-battlefield_1-ekshn_igra-voda-podzemnye_vody-500x.jpg"
);
</script>

<style scoped lang="scss">
.post {
  &__image {
    align-self: center;
    border-radius: 10px;
  }
  &__left {
    display: flex;
    flex-direction: column;
  }
}
</style>
