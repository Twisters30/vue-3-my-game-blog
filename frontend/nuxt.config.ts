// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  app: {
    head: {
      charset: 'utf-8',
      viewport: 'width=500, initial-scale=1',
      title: 'My GameBlog',
      link: [{rel:'stylesheet', href:'ldld.css', type: 'text/css'}],
      script: [{src: 'ldld.js',}],
      meta: [
        // <meta name="description" content="My amazing site">
        { name: 'Пет проект', content: 'Пет проет с использованием технологий Nuxt 3,PHP' }
      ],
    }
  },
  // ssr: false,
  modules: ['@pinia/nuxt'],
  css: ['normalize.css/normalize.css','bootstrap/dist/css/bootstrap.min.css'],
  vite: {
    server: {
      watch: {
        usePolling: true
      }
    },
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
