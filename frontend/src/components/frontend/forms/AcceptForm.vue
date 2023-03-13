<template>
  <div class="accept">
    <div class="accept__wrapper">
      <h5 class="mb-2">Вы Уверенны?</h5>
      <button
        @click="$emit('acceptAction', true)"
        class="accept__btn btn btn-primary mb-2"
      >
        Выйти
      </button>
      <button
        @click="$emit('acceptAction', false)"
        class="accept__btn btn btn-primary"
      >
        Отмена
      </button>
    </div>
  </div>
</template>

<script setup>
import { defineEmits } from "vue";
defineEmits(["acceptAction"]);
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
