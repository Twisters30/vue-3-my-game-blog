<template>
    <div>
        <h2 class="main-title">Регистрация на "Сайт"</h2>
        <register-form />
    </div>
</template>

<script>
    import RegisterForm from '../components/forms/RegisterForm.vue'

    export default {
        components: { RegisterForm }
    }
</script>

<style lang="scss">
@import url('../assets/scss/global.scss');
</style>