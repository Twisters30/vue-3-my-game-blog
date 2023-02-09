<template>
    <div class="form__wrapper">
        <form
        @submit.prevent
        action="index.php"
        class="form__main"
        >
        <div class="form__input-wrapper my-3">
            <span class="form__input-name">Имя</span>
            <label class="form__label">
                <input v-model="formData.name" type="name" name="name" class="form__input" placeholder="Введите Имя">
            </label>
        </div>
        <div class="form__input-wrapper my-3">
            <span class="form__input-name">Email</span>
            <label class="form__label">
                <input v-model="formData.email" type="text" name="email" class="form__input" placeholder="Введите email">
            </label>
        </div>
        <div class="form__input-wrapper my-3">
            <span class="form__input-name">Пароль</span>
            <label class="form__label">
                <input v-model="formData.password" type="password" name="password" class="form__input" placeholder="Введите пароль">
            </label>
        </div>
        <div class="form__input-wrapper my-3">
            <span class="form__input-name">Повторите пароль</span>
            <label class="form__label">
                <input v-model="formData.repPassword" type="password" name="password" class="form__input" placeholder="Введите пароль">
            </label>
        </div>
        <button @click="register" class="form__btn-register btn btn-outline-success main-btn">Регистрация</button>
        </form>
    </div>
</template>
<script setup>
import axios from 'axios';
const formData = reactive({});

const register = async () => {
  const response = await axios.post('http://localhost:80/register',{
    "name":"VERS"
  });
  // try {
  //   const response = await axios.post('http://localhost:80/register',{
  //     name:12456789
  //   });
  //   // const parseResponse = await response.json();
  //   // console.log(parseResponse)
  // } catch (error) {
  //   console.log(error)
  // }

}

</script>
<style lang="scss" scoped>
.form {
    &__wrapper {
        display: flex;
        flex-direction: column;
    }
    &__main {
        display: flex;
        flex-direction: column;
        background: #fff;
        padding: 25px;
        border-radius: 15px;
        align-self: center;
        -webkit-box-shadow: 2px 2px 8px 6px rgba(34, 60, 80, 0.2);
        -moz-box-shadow: 2px 2px 8px 6px rgba(34, 60, 80, 0.2);
        box-shadow: 2px 2px 8px 6px rgba(34, 60, 80, 0.2);
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
    &__btn-register {
        margin-bottom: 1rem;
    }
}
    
</style>