<template>
  <div class="header__root line">
    <div class="container">
      <header class="header">
        <div class="header__logo logo hui">MyGameBlog!</div>
        <nav class="nav">
          <ul class="nav__list">
            <li class="nav__item">
              <router-link class="btn main-link" to="/">Статьи</router-link>
            </li>
            <li class="nav__item">
              <router-link class="btn main-link" to="/about">О нас</router-link>
            </li>
            <li class="nav__item">
              <router-link class="btn main-link" to="/join"
                >Стать автором</router-link
              >
            </li>
            <li class="nav__item">
              <router-link class="btn main-link" to="/profile"
                >Профиль</router-link
              >
            </li>
            <li
              v-if="!loginStore.getAccessTokenStorage()"
              class="nav__item item-login"
            >
              <Loader v-if="loginStore.userDataLoading" />
              <button
                v-else
                class="btn main-link"
                @click="loginStore.showLoginPage"
              >
                Войти
              </button>
            </li>
            <li v-else class="nav__item item-login">
              <Loader v-if="loginStore.userDataLoading" />
              <button
                v-else
                class="btn main-link"
                @click="loginStore.acceptAction"
              >
                Выйти
              </button>
              <AcceptForm
                @acceptAction="loginStore.acceptAction"
                v-if="loginStore.acceptWindowShow"
              />
            </li>
          </ul>
        </nav>
      </header>
    </div>
  </div>
</template>

<script setup>
/* eslint-disable */
import { useLoginStore } from "@/stores/login.js";
import { onMounted } from "vue";
import Loader from "@/components/Loader.vue";
import AcceptForm from "./forms/AcceptForm.vue";
const loginStore = useLoginStore();
onMounted(() => {
  loginStore.disableLoader();
});
</script>
<style lang="scss">
.item-login {
  width: 71.69px;
}

.header {
  &__root {
    backdrop-filter: blur(15px);
  }
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px 0;

  &__logo {
    font-size: 30px;
  }
}
.nav {
  &__list {
    display: flex;
  }
}
</style>
