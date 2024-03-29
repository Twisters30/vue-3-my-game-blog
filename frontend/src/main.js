import { createApp } from "vue";
import App from "./App.vue";
import { createPinia } from "pinia";
import axios from "axios";
import VueAxios from "vue-axios";
import router from "./router";
const pinia = createPinia();
createApp(App).use(router).use(VueAxios, axios).use(pinia).mount("#app");
