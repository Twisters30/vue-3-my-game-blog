<template>
    <div class="form__wrapper" id="modal-overlay" @click="closeModalOutside($event)">
        <form class="form__main" @submit.prevent action="index.php" >
            <div class="form__input-wrapper my-3">
                <span class="form__input-name">Email</span>
                <label class="form__label">
                    <input type="text" name="email" class="form__input" placeholder="Введите email">
                </label>
            </div>
            <div class="form__input-wrapper my-3">
                <span class="form__input-name">Пароль</span>
                <label class="form__label">
                    <input type="password" name="password" class="form__input" placeholder="Введите пароль">
                </label>
            </div>
            <button class="form__btn-login btn btn-outline-success main-btn">Войти</button>
            <span class="form__link-wrapper">
                <NuxtLink class="main-link text-danger" to="#">забыли пароль?</NuxtLink>
                <NuxtLink @click="useLoginStore.showPage" class="main-link text-danger" to="/register">регистрация</NuxtLink>
            </span>
        </form>
    </div>
</template>

<script>
import { useLoginStore } from '../../stores/login.js';

export default {
    created() {
        this.useLoginStore = useLoginStore();
    },
    methods: {
        closeModalOutside(event) {
            if (event.target.id === 'modal-overlay') {
                this.useLoginStore.showPage();
            }
        }
    },
}
</script>

<style lang="scss" scoped>
.form {
    &__wrapper {
        z-index: 1;
        position: absolute;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        background: rgba(121, 110, 116, 0.8);
    }
    &__main {
        max-width: 450px;
        position: fixed;
        z-index: 99;
        top: calc(50% - 138px);
        left: calc(50% - 225px);
        display: flex;
        flex-direction: column;
        background: #fff;
        padding: 25px;
        border-radius: 15px;
        align-self: center;
        -webkit-box-shadow: 1px 1px 10px 0px rgba(34, 60, 80, 0.05);
        -moz-box-shadow: 1px 1px 10px 0px rgba(34, 60, 80, 0.05);
        box-shadow: 1px 1px 10px 0px rgba(34, 60, 80, 0.05);
        & div:last-of-type {
            margin-bottom: 2rem !important;
        }
    }
    &__input-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    &__input {
        width: 300px;
        padding: 3px 10px;
        border-radius: 5px;
        border-color: transparent;
        -webkit-box-shadow: 0px 0px 1px 1px rgba(34, 60, 80, 0.75);
        -moz-box-shadow: 0px 0px 1px 1px rgba(34, 60, 80, 0.75);
        box-shadow: 0px 0px 1px 1px rgba(34, 60, 80, 0.75);
    }
    &__input-name {
        display: block;
        margin-right: 15px;
    }
    &__btn-login {
        min-width: 150px;
        margin-bottom: 1rem;
    }
    &__link-wrapper {
        display: flex;
        justify-content: flex-end;
        & a {
            margin-right: 5px;
        }
        & a:last-of-type {
            margin-right: 0;
        }
    }
}
    
</style>