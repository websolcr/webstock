import {createRouter, createWebHistory} from "vue-router"

import store from "@/store"
import Audits from "@/views/Audits"
import AppLayout from "@/layout/AppLayout"
import UserManagement from "@/views/UserManagement"
import WithoutTenantLayout from "@/layout/WithoutTenantLayout"
import CreateOrganization from "@/views/organization/OrganizationCreate"
import OrganizationIndex from "@/views/organization/OrganizationIndex"
import Suppliers from "@/views/Suppliers"
import Dashboard from "@/views/Dashboard"

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
    name: 'Home',
    meta: {auth: true, tenant: true},
    component: AppLayout,
    children: [
      {
        path: '/dashboard',
        name: 'Dashboard',
        component: Dashboard,
      },
      {
        path: '/user-management',
        name: 'UserManagement',
        component: UserManagement
      },
      {
        path: '/audits',
        name: 'Audits',
        component: Audits
      },
      {
        path: '/suppliers',
        name: 'Suppliers',
        component: Suppliers
      },
    ]
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

router.beforeEach((to, from, next) => {
  if (to.path === '/'){
    next({name: 'Dashboard'})
    return
  }

  if (to.path === '/dashboard') {
    store.dispatch('fetchActiveOrganization').then(() => {
      !store.state.organization.id ? next({name: 'OrganizationIndex'}) : next()
    })
    return
  }

  if (to.meta.tenant && !store.state.organization) {
    store.commit('resetOrganization')

    next({name: 'OrganizationIndex'})
    return
  }

  next()
})

export default router
