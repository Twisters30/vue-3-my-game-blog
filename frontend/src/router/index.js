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
  {
    path: "/admin/dashboard",
    name: "dashboard",
    component: () => import("@/views/admin/dashboard.vue"),
  },
  {
    path: "/admin/posts",
    name: "adminPosts",
    component: () => import("@/views/admin/posts/index.vue"),
  },
  {
    path: "/admin/create",
    name: "adminPostsCreate",
    component: () => import("@/views/admin/posts/create.vue"),
  },
  {
    path: "/admin/posts/:id",
    name: "adminPostsCreate",
    component: () => import("@/views/admin/posts/edit.vue"),
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

router.beforeEach(async (to, from, next) => {
  const { useLayoutStore } = await import("@/stores/layout.js");
  const layoutStore = useLayoutStore();
  if (to.path.startsWith("/admin")) {
    layoutStore.switchLayout("admin");
  } else {
    layoutStore.switchLayout("default");
  }
  next();
});

export default router;
