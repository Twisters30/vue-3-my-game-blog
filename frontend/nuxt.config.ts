// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  router: {
    linkActiveClass: 'active',
  },
  modules: ['@pinia/nuxt'],
  css: ['normalize.css/normalize.css','bootstrap/dist/css/bootstrap.min.css'],
  vite: {
    define: {"process.env.DEBUG": false},
    css: {
      preprocessorOptions: {
        scss: {
          additionalData: '@use "@/assets/scss/global.scss" as *;'
        } 
      }
    }
  }
})
