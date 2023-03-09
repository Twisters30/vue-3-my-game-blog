<template>
    <div>
        <div class="post__wrapper line">
            <h3 class="post__title sub-title">
              {{ post.name }}
            </h3>
            <div class="post__left">
              <img class="post__image" :src="apiHost + '/' + post.image" alt="Изображение статьи">
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
    </div>
</template>
<script setup>
import { apiHost } from "@/config/api.js";

const props = defineProps(['post'])
</script>
<style lang="scss" scoped>

.post {
    &__wrapper {
        display: flex;
        flex-direction: column;
    }
    &__footer-wrapper {
        display: flex;
        flex-direction: column;
        margin-bottom: 5px;
    }
    &__footer {
        align-self: flex-end;
    }
    &__image {
        width: 600px;
        height: 300px;
        margin-bottom: 15px;
    }
    &__text-preview {
        font-size: 21px;
        text-align: left;
    }
    &__left {
        display: flex;
        gap: 1rem;
    }
    &__separator {
        padding: 0 5px;
    }
    &__title {
        text-align: left;
    }
}
    
</style>