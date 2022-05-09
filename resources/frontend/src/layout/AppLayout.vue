<template>
  <div
    v-if="hasActiveTenant"
    class="flex h-screen"
  >
    <div class="flex bg-blue-200 h-screen w-72">
      sidebar
    </div>
    <div class="flex-1">
      <div class="bg-blue-600 h-16">
        Navbar

        {{ organization.tenant.name }}
      </div>
      <div class="bg-gray-600 h-screen">
        <router-view :key="$route.fullPath" />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AppLayout',

  computed: {
    hasActiveTenant () {
      return !!this.$store.state.tenancy
    },

    organization() {
      return this.$store.state.tenancy
    }
  }
}
</script>
