<template>
  <div>
    <div class="page-wrapper">
      <img class="bg-page" src="@/assets/images/battlefield-v.jpg" alt="обои">
      <div class="wrapper-content">
        <TheHeader />
        <div class="container">
          <main class="main my-4">
            <slot />
            <LoginForm v-if="loginStore.isLoginPageShow" />
          </main>
        </div>
        <TheFooter />
      </div>
    </div>
  </div>
</template>

<script setup>
import { useLoginStore } from "../stores/login";
import LoginForm from '@/components/frontend/forms/LoginForm.vue';
import TheHeader from '@/components/frontend/TheHeader.vue';
import TheFooter from "@/components/frontend/TheFooter.vue";
const loginStore = useLoginStore();

</script>

<style lang="scss">
.wrapper-content {
  position: relative;
  z-index: 10;
}

.main {
  height: 100vh;
  background: rgba(255,255,255, 0.9);
  border-radius: 10px;
}

.page-wrapper {
  position: relative;
  height: 100vh;
  z-index: 2;
}

.bg-page{
  width: 100%;
  position: absolute;
  z-index: 1;
  top: 0;
  right: 0;
  left: 0;
  bottom: 0;
}
.zoom {
  animation: scale 40s linear infinite;
}
@keyframes scale {
  50% {
    -webkit-transform:scale(1.2);
    -moz-transform:scale(1.2);
    -ms-transform:scale(1.2);
    -o-transform:scale(1.2);
    transform:scale(1.2);
  }
}
</style>