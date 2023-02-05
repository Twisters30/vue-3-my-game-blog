<template>
    <div>
        <h1 class="main-title">Articles</h1>
        <div class="post__feed">
            <Post />
        </div>
    </div>
</template>

<script>
import Post from '@/components/Post.vue';

export default {
comments: { Post }

}

</script>

<style lang="scss">
.post {
   &__feed {
    padding: 0 50px;
   } 
}

</style>