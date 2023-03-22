<template>
  <div
    class="form__wrapper"
    id="modal-overlay"
    @click="loginStore.closeModalOutside($event)"
  >
    <Form
      class="form__main"
      @submit="loginStore.loginAction"
      :validation-schema="schemaLogin"
      v-slot="{ meta }"
    >
      <h5 class="form__title main-title"></h5>
      <div class="form__input-wrapper">
        <div class="form__input__sub-wrap">
          <span class="form__input-name">Email</span>
          <label class="form__label">
            <Field
              v-model.trim="loginStore.formData.email"
              type="email"
              name="email"
              class="form__input"
              :class="{ 'validate-success': meta.valid && meta.touched }"
              placeholder="Введите email"
            />
          </label>
        </div>
        <ErrorMessage class="form__input-error" name="email" />
      </div>
      <div class="form__input-wrapper">
        <div class="form__input__sub-wrap">
          <span class="form__input-name">Пароль</span>
          <label class="form__label">
            <Field
              v-model.trim="loginStore.formData.password"
              type="password"
              name="password"
              class="form__input"
              :class="{ 'validate-success': meta.valid && meta.touched }"
              placeholder="Введите пароль"
            />
          </label>
        </div>
        <ErrorMessage class="form__input-error" name="password" />
      </div>
      <ButtonBorderAnimate
        btnText="Войти"
        btnType="submit"
        class="form__submit-login"
        :class="{ 'btn-animate': meta.valid && meta.touched }"
      />
      <span class="form__link-wrapper">
        <a class="main-link form__link" href="#">забыли пароль?</a>
        <router-link
          @click="loginStore.showLoginPage"
          class="main-link form__link"
          to="/register"
          >регистрация</router-link
        >
      </span>
    </Form>
  </div>
</template>

<script setup>
import ButtonBorderAnimate from "@/components/buttons/ButtonBorderAnimate.vue";
import { useLoginStore } from "@/stores/login.js";
import { Form, Field, ErrorMessage } from "vee-validate";
import { schemaLogin } from "@/helpers/validatorRules.js";
const loginStore = useLoginStore();
</script>

<style lang="scss" scoped>
.form {
  &__submit-login {
    margin-bottom: 20px;
  }
  &__link {
    color: #fff;
    &:hover {
      color: #00a87d;
    }
  }
  &__title {
    font-size: 32px;
    padding-bottom: 30px;
    color: transparent;
    pointer-events: none;
  }
  &__input__sub-wrap {
    display: flex;
    justify-content: space-between;
  }
  &__input-error {
    position: absolute;
    bottom: -25px;
    align-self: center;
    color: gold;
  }
  &__label {
    display: flex;
    flex-direction: column;
  }
  &__wrapper {
    z-index: 1;
    position: absolute;
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    background: rgba(121, 110, 116, 0.8);
    backdrop-filter: blur(15px);
  }
  &__main {
    max-width: 450px;
    position: sticky;
    z-index: 99;
    top: calc(50% - 138px);
    left: calc(50% - 225px);
    display: flex;
    flex-direction: column;
    background: transparent;
    backdrop-filter: blur(15px);
    color: #fff;
    padding: 25px;
    border: 2px solid rgba(255, 255, 255, 0.5);
    border-radius: 15px;
    align-self: center;
    -webkit-box-shadow: 1px 1px 10px 0px rgba(34, 60, 80, 0.05);
    -moz-box-shadow: 1px 1px 10px 0px rgba(34, 60, 80, 0.05);
    box-shadow: 1px 1px 10px 0px rgba(34, 60, 80, 0.05);
    & div:last-of-type {
      //margin-bottom: 2rem !important;
    }
  }
  &__input-wrapper {
    display: flex;
    position: relative;
    margin-bottom: 30px;
    justify-content: space-between;
    flex-direction: column;
  }
  &__input {
    width: 300px;
    padding: 3px 10px;
    border-color: transparent;
    background: transparent;
    border-bottom: 2px solid #fff;
    color: #fff;
    &:focus {
      outline: none;
    }
  }
  &__input-name {
    display: block;
    align-self: center;
    margin-right: 15px;
  }
  &__btn-login {
    min-width: 150px;
    margin-bottom: 1rem;
    color: #000;
    background: #fff;
    border: transparent;
    &:hover {
      border-color: #00a87d !important;
      color: #00a87d;
    }
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
