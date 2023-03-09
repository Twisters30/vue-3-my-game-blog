<template>
  <div class="card card-primary">
    <div class="card-header">
      <h2 class="card-title">Настройки профиля</h2>
    </div>
    <form @submit.prevent="$emit('submitProfile', formData)">
      <div class="card-body">
        <div class="form-group">
          <label for="inputName">Имя</label>
          <input
            v-model="formData.name"
            type="text"
            class="form-control"
            id="inputName"
          />
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input
            v-model="formData.email"
            type="text"
            class="form-control"
            id="email"
          />
        </div>
        <div class="form-group">
          <label for="email">Пароль</label>
          <input
            v-model="formData.password"
            type="text"
            class="form-control"
            id="password"
          />
        </div>
        <div class="form-group">
          <label for="description">О себе</label>
          <input
            v-model="formData.description"
            type="text"
            class="form-control"
            id="description"
          />
        </div>
        <div class="form-group">
          <label for="phone">Номер телефона</label>
          <input
            v-model="formData.phone"
            type="text"
            class="form-control"
            id="phone"
          />
        </div>
        <div class="form-group">
          <label for="socials">Соц сети</label>
          <input
            v-model="formData.socials"
            type="text"
            class="form-control"
            id="socials"
          />
        </div>
        <ImageInput></ImageInput>
      </div>
      <div class="card-footer bg-transparent">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { defineProps, reactive } from "vue";
import ImageInput from "@/components/inputs/ImageInput.vue";
defineProps({
  userData: {
    default: {},
    type: () => Object,
  },
});
const formData = reactive({});
</script>

<style scoped></style>
