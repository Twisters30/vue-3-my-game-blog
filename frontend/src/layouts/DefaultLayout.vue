<template>
  <div
    class="page-wrapper bg-page"
    :style="{ backgroundImage: `url(${require('@/assets/' + bgImage)})` }"
  >
    <div class="wrapper-content">
      <TheHeader />
      <div class="container">
        <main class="main my-4 border-line">
          <slot />
          <login-form v-if="loginStore.isLoginPageShown" />
        </main>
      </div>
      <TheFooter />
    </div>
  </div>
</template>

<script setup>
import { useLoginStore } from "@/stores/login";
import LoginForm from "@/components/frontend/forms/LoginForm.vue";
import TheHeader from "@/components/frontend/TheHeader.vue";
import TheFooter from "@/components/frontend/TheFooter.vue";
const loginStore = useLoginStore();
const bgImage = "images/battlefield-v.jpg";
</script>

<style lang="scss">
.wrapper-content {
  position: relative;
  z-index: 10;
  padding-bottom: 100px;
}

.main {
  min-height: 100vh;
  background: rgba(255, 255, 255, 0.9);
  border-radius: 10px;
  padding: 50px;
}

.page-wrapper {
  position: relative;
  min-height: 100vh;
  z-index: 2;
}

.bg-page {
  width: 100%;
  background-position: top;
  background-size: cover;
  background-attachment: fixed;
}
.zoom {
  animation: scale 40s linear infinite;
}
@keyframes scale {
  50% {
    -webkit-transform: scale(1.2);
    -moz-transform: scale(1.2);
    -ms-transform: scale(1.2);
    -o-transform: scale(1.2);
    transform: scale(1.2);
  }
}
</style>
