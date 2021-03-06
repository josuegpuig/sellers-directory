import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import MainNavbar from "@/layout/MainNavbar.vue";
import MenuDirectory from "@/layout/MenuDirectory.vue";
import MainFooter from "@/layout/MainFooter.vue";
import Index from "@/views/Index.vue";
import IndexSeller from "@/views/IndexSeller.vue";

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
  {
    path: "/sellerview",
    name: "Seller",
    components: { default: IndexSeller, header: MenuDirectory, footer: MainFooter },
    props: {
      header: { colorOnScroll: 400 },
      footer: { backgroundColor: "black" }
    }
  },
  {
    path: "/login",
    name: "Login",
    components: { 
      default: () => import(/* webpackChunkName: "login" */ '../views/Login.vue'), 
      header: MenuDirectory, 
      footer: MainFooter 
    },
    props: {
      header: { type: "dark", initialTransparent: false },
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
