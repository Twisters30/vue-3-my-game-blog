<template>
    <div>
        <h1 class="main-title">Articles</h1>
        <div class="post__feed">
            <Post />
        </div>
    </div>
</template>

<script setup>
import Post from "@/components/frontend/Post.vue";
definePageMeta({
  layout: 'default'
})

</script>

<style lang="scss">
.post {
   &__feed {
    padding: 0 50px;
   } 
}

</style>