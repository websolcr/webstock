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
        <Navbar
          :is-showing-notification-widget="isShowingNotificationWidget"
          @toggleNotificationWidget="toggleNotificationWidget"
        />
      </div>
      <div class="bg-gray-600 h-screen">
        <router-view :key="$route.fullPath" />
      </div>
    </div>

    <notification-widget
      v-if="isShowingNotificationWidget"
      :notifications="notifications"
      :is-showing-notification-widget="isShowingNotificationWidget"
      @toggleNotificationWidget="toggleNotificationWidget"
    />
  </div>
</template>

<script>
import Navbar from "@/components/layout-components/Navbar"
import NotificationWidget from "@/components/notification/NotificationWidget"

export default {
  name: 'AppLayout',

  components: {
    Navbar,
    NotificationWidget,
  },

  data() {
    return {
      isShowingNotificationWidget: false,
      notifications: Array(12).fill({
        id: 1,
        subject: 'Velit placeat sit ducimus non sed',
        time: '1d ago',
        preview:
          'Doloremque dolorem maiores assumenda dolorem facilis. Velit vel in a rerum natus facere. Enim rerum eaque qui facilis. Numquam laudantium sed id dolores omnis in. Eos reiciendis deserunt maiores et accusamus quod dolor.',
      }),
    }
  },

  computed: {
    hasActiveTenant() {
      return !!this.$store.state.tenancy
    },

    organization() {
      return this.$store.state.tenancy
    }
  },

  methods: {
    toggleNotificationWidget() {
      this.isShowingNotificationWidget = !this.isShowingNotificationWidget
    },
  }
}
</script>
