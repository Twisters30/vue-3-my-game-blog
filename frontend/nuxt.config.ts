// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  routeRules: {
    '/admin/**': { ssr: false },
  },
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
      script: [
        { src: '/js/jquery/jquery.min.js' },
        { src: '/js/bootstrap.bundle.min.js'},
        { src: '/js/adminlte.min.js' },
        { src: '/js/summernote-bs4.min.js' },
      ]
    }
  },
  // ssr: true,
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
