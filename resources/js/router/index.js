import { createWebHistory, createRouter } from "vue-router";
import home from "../views/home.vue";

import client_list from "../views/client/list.vue"
import client_register from "../views/client/register.vue"

import product_list from "../views/product/list.vue"
import product_register from "../views/product/register.vue"

import sell_list from "../views/sell/list.vue"
import sell_register from "../views/sell/register.vue"

const routes = [
  {
    path: "/",
    name: "home",
    component: home,
  },
  {
    path: "/client/list",
    name: "client_list",
    component: client_list,
  },
  {
    path: "/client/new",
    name: "client_register",
    component: client_register,
  },
  {
    path: "/product/list",
    name: "product_list",
    component: product_list,
  },
  {
    path: "/product/new",
    name: "product_register",
    component: product_register,
  },
  {
    path: "/sell/list",
    name: "sell_list",
    component: sell_list,
  },
  {
    path: "/sell/register",
    name: "sell_register",
    component: sell_register,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;