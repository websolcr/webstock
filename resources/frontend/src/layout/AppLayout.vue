<template>
  <div
    v-if="hasActiveTenant"
    class="flex h-screen"
  >
    <div class="flex bg-blue-200 h-screen w-72">
      sidebar
    </div>
    <div class="flex-1">
      <div>
        <Navbar />
      </div>
      <div class="bg-gray-600 h-screen">
        <router-view :key="$route.fullPath" />
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from "@/components/layout-components/Navbar"

export default {
  name: 'AppLayout',
  components: {
    Navbar,
  },

  computed: {
    hasActiveTenant () {
      return !!this.$store.state.tenancy
    },
  }
}
</script>
