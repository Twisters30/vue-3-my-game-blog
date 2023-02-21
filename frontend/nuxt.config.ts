// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: {
    enabled: false,
  },
  app: {
    head: {
      charset: 'utf-8',
      viewport: 'width=500, initial-scale=1',
      title: 'My GameBlog',
      meta: [
        // <meta name="description" content="My amazing site">
        { name: 'Пет проект', content: 'Пет проет с использованием технологий Nuxt 3,PHP' }
      ],
    }
  },
  // ssr: false,
  modules: ['@pinia/nuxt','@nuxt/devtools'],
  css: ['normalize.css/normalize.css','bootstrap/dist/css/bootstrap.min.css','@fortawesome/fontawesome-free/css/all.css'],
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
