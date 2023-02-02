<template>
    <div class="header__root sides-2 border">
        <div class="container">
            <header class="header">
                <div class="header__logo logo">MY ARTBLoG</div>
                <nav class="nav">
                    <ul class="nav__list">
                        <li class="nav__item"><NuxtLink class="btn" to="/articles">Статьи</NuxtLink></li>
                        <li class="nav__item"><NuxtLink class="btn" to="/about">О нас</NuxtLink></li>
                        <li class="nav__item"><NuxtLink class="btn" to="/join">Стать автором</NuxtLink></li>
                        <li class="nav__item"><NuxtLink class="btn" to="/login">Войти</NuxtLink></li>
                    </ul>
                </nav>
            </header>
        </div>
    </div>
</template>

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