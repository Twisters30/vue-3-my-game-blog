<template>
  <div class="form-group">
    <label class="mb-2" for="avatar">Аватар</label>
    <div class="input-group d-flex">
      <div class="custom-file">
        <input
          ref="avatarInput"
          @change="onFileChange($event, 'image')"
          type="file"
          class="form-control"
          id="avatar"
        />
      </div>
    </div>
  </div>
</template>

<script setup></script>

<style scoped></style>
