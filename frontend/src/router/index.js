import { createRouter, createWebHistory } from "vue-router";
const routes = [
  {
    path: "/:pathMatch(.*)*",
    name: "notFoundPage",
    component: () => import("@/views/404.vue"),
  },
  {
    path: "/",
    name: "index",
    component: () => import("@/views/index.vue"),
  },
  {
    path: "/post/:id",
    name: "post",
    component: () => import("@/views/post.vue"),
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
    path: "/admin/posts/create",
    name: "adminPostsCreate",
    component: () => import("@/views/admin/posts/create.vue"),
  },
  {
    path: "/admin/post/:id",
    name: "adminPostsEdit",
    component: () => import("@/views/admin/posts/edit.vue"),
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});
router.beforeResolve(async (to, from, next) => {
  const { useLayoutStore } = await import("@/stores/layout.js");
  const { storeToRefs } = await import("pinia");
  const layoutStore = useLayoutStore();
  const { layout } = storeToRefs(layoutStore);
  if (to.path.startsWith("/admin")) {
    if (layout.value !== "admin") {
      layoutStore.switchLayout("admin");
    }
  } else {
    if (layout.value !== "default") {
      layoutStore.switchLayout("default");
    }
  }
  next();
});

export default router;
