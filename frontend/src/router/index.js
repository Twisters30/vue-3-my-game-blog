import { createRouter, createWebHistory } from "vue-router";
const routes = [
  {
    path: "/",
    name: "index",
    component: () => import("@/views/index.vue"),
  },
  {
    path: "/about",
    name: "about",
    component: () => import("@/views/about.vue"),
  },
  {
    path: "/profile",
    name: "profile",
    component: () => import("@/views/profile.vue"),
  },
  {
    path: "/register",
    name: "register",
    component: () => import("@/views/register.vue"),
  },
  {
    path: "/join",
    name: "join",
    component: () => import("@/views/join.vue"),
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
