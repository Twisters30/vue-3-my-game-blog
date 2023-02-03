<template>
    <div class="header__root sides-2 border">
        <div class="container">
            <header class="header">
                <div class="header__logo logo">MY GameBLoG</div>
                <nav class="nav">
                    <ul class="nav__list">
                        <li class="nav__item"><NuxtLink class="btn" to="/articles">Статьи</NuxtLink></li>
                        <li class="nav__item"><NuxtLink class="btn" to="/about">О нас</NuxtLink></li>
                        <li class="nav__item"><NuxtLink class="btn" to="/join">Стать автором</NuxtLink></li>
                        <li class="nav__item"><button class="btn" @click="loginStore.showPage">Войти</button></li>
                    </ul>
                </nav>
            </header>
        </div>
    </div>
</template>

<script>
import { useLoginStore } from '../stores/login.js';

export default {
    created() {
    this.loginStore = useLoginStore();
},
}

</script>

<style lang="scss">
.sides-2 {
	border-image: linear-gradient(to bottom, turquoise, greenyellow) 0 1;
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