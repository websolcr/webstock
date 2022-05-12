import {createRouter, createWebHistory} from "vue-router"
import HomePage from "@/views/HomePage"
import CreateOrganization from "@/views/organization/OrganizationCreate"
import OrganizationIndex from "@/views/organization/OrganizationIndex"
import store from "@/store"
import AppLayout from "@/layout/AppLayout"
import WithoutTenantLayout from "@/layout/WithoutTenantLayout"
import UserManagement from "@/views/UserManagement"

const routes = [
  {
    path: '/app',
    name: 'App',
    meta: {auth: true},
    component: WithoutTenantLayout,
    children: [
      {
        path: '/organization-index',
        name: 'OrganizationIndex',
        component: OrganizationIndex,
      },
      {
        path: '/create-organization',
        name: 'CreateOrganization',
        component: CreateOrganization
      },
    ]
  },
  {
    path: '/',
    name: 'Dashboard',
    meta: {auth: true, tenant: true},
    component: AppLayout,
    children: [
      {
        path: '/home',
        name: 'Home',
        component: HomePage,
      },
      {
        path: '/user-management',
        name: 'UserManagement',
        component: UserManagement
      }
    ]
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

router.beforeEach((to, from, next) => {

  if (to.meta.tenant && !store.state.tenancy) {
    next({name: 'OrganizationIndex'})
  }

  if (to.path === '/') {
    next({name: 'Home'})
  }

  next()
})

export default router
