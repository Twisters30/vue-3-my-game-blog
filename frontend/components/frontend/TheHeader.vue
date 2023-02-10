<template>
    <div class="header__root line">
        <div class="container">
            <header class="header">
                <div class="header__logo logo">MY GameBLoG</div>
                <nav class="nav">
                    <ul class="nav__list">
                        <li class="nav__item"><NuxtLink @click="userActionWithToken" class="btn main-link" to="/articles">Статьи</NuxtLink></li>
                        <li class="nav__item"><NuxtLink class="btn main-link" to="/about">О нас</NuxtLink></li>
                        <li class="nav__item"><NuxtLink class="btn main-link" to="/join">Стать автором</NuxtLink></li>
                        <li v-if="!loginStore.token" class="nav__item"><button class="btn main-link" @click="loginStore.showPage">Войти</button></li>
                        <li v-else class="nav__item"><button class="btn main-link" @click="loginStore.logout">Выйти</button></li>
                    </ul>
                </nav>
            </header>
        </div>
    </div>
</template>

<script setup>
import { useLoginStore } from '../../stores/login.js';
import axios from "axios";

const loginStore = useLoginStore();

const userActionWithToken = async () => {
  if (!loginStore.token) return;
  console.log(loginStore.token, 'АВТОРИЗИРОВАН')
  try {
    const result = await axios.get('http://localhost:80/admin/posts', {
      headers: {
        'Authorization': `Bearer ${loginStore.token}`
      }
    })
    console.log(result);
  } catch (error) {
    console.log(error);
  }
}

</script>

<style lang="scss">

.line{
    text-align:center;
    border-bottom: 2px solid transparent;
    border-image: linear-gradient(0.25turn, rgba(255,249,34), rgba(255,0,128), rgba(56,2,155,0));
    border-image-slice: 1;
    width:100%;
}

.header {
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