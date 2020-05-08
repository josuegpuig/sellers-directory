import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import MainNavbar from "@/layout/MainNavbar.vue";
import MainFooter from "@/layout/MainFooter.vue";
import Index from "@/views/Index.vue";

Vue.use(VueRouter)

  const routes = [
  {
    path: '/',
    name: 'Home',
    components: { default: Home, header: MainNavbar, footer: MainFooter },
    props: {
      header: { colorOnScroll: 400 },
      footer: { backgroundColor: "black" }
    }
  },
  {
    path: '/about',
    name: 'About',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  },
  {
    path: "/components",
    name: "Index",
    components: { default: Index, header: MainNavbar, footer: MainFooter },
    props: {
      header: { colorOnScroll: 400 },
      footer: { backgroundColor: "black" }
    }
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
