<template>
    <div>
        <h2 class="main-title">Регистрация на "Сайт"</h2>
        <register-form />
    </div>
</template>

<script setup>
    import RegisterForm from '../components/frontend/forms/RegisterForm.vue'
    definePageMeta({
      layout: 'default'
    })
</script>

<style lang="scss">
@import url('../assets/scss/global.scss');
</style>