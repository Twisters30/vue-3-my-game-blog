<template>
  <div class="main-page">
    <TheHeader />
    <div class="container">
      <main class="py-4">
        <NuxtPage />
        <LoginForm v-if="loginStore.isLoginPageShow"/>
      </main>
    </div>  
  </div>
</template>

<script>
import { useLoginStore } from './stores/login.js';
import LoginForm from './components/forms/LoginForm.vue';
export default {
  components: { LoginForm },
  created() {
    this.loginStore = useLoginStore();
},
}

</script>

<style lang="scss">
.main-page {
  height: 100vh;
  background: rgb(34,193,195);
  background: linear-gradient(156deg, rgba(34,193,195,1) 0%, rgba(154,253,45,1) 100%);
}
</style>