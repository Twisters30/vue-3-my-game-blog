<template>
  <div class="accept">
    <div class="accept__wrapper">
      <h5 class="mb-2">Вы Уверенны?</h5>
      <button @click="loginStore.acceptAction(true)" class="accept__btn btn btn-primary mb-2">Выйти</button>
      <button @click="loginStore.acceptAction(false)" class="accept__btn btn btn-primary">Отмена</button>
    </div>

  </div>
</template>

<script setup>
import { useLoginStore } from "../../../stores/login.js";
const loginStore = useLoginStore();

</script>

<style lang="scss" scoped>
.accept {
  min-width: 200px;
  position: absolute;
  right: 90px;
  &__wrapper {
    display: flex;
    flex-direction: column;
    padding: 25px;
    background: aliceblue;
    border-radius: 12px;
   }
}
</style>