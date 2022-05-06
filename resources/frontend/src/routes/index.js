import {createRouter, createWebHistory} from "vue-router"
import HomePage from "@/views/HomePage.vue"
import CreateOrganization from "@/views/CreateOrganization.vue"
import WithoutTenantLayout from "@/layout/WithoutTenantLayout.vue"
import AppLayout from "@/layout/AppLayout.vue"
import OrganizationIndex from "@/views/OrganizationIndex.vue"

const routes = [
  {
    path: '/without-tenant',
    name: 'WithoutTenant',
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
      }
    ]
  },

  {
    path: '/with-tenant',
    name: 'WithTenant',
    component: AppLayout,
    children: [
      {
        path: '/',
        name: 'Home',
        component: HomePage,
      },
    ]
  }

]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
