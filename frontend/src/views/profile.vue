<template>
  <div>
    <profile-form :userData="userData" />
  </div>
</template>

<script setup>
import ProfileForm from "../components/frontend/forms/ProfileForm.vue";
const userData = {};
</script>

<style scoped></style>
