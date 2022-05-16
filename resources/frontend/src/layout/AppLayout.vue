<template>
  <div
    v-if="hasActiveTenant"
    class="flex h-screen"
  >
    <div
      class="sidebar"
      :style="{width: sidebarWidth + 'px'}"
    >
      <div class="flex p-4 justify-between text-white">
        <div v-if="isSideBarPinned">
          Logo goes here
        </div>
        <div v-else>
          LG
        </div>
        <svg-icon
          :icon="isSideBarPinned ? 'arrowCircleLeft' : 'arrowCircleRight'"
          class="text-gray-600 hover:text-white cursor-pointer"
          @click="toggleSideBar"
        />
      </div>
      <sidebar-link
        :is-side-bar-pinned="isSideBarPinned"
        tooltip="User Management"
        label="User Management"
        named-route="UserManagement"
      />

      <sidebar-link
        :is-side-bar-pinned="isSideBarPinned"
        tooltip="Audits"
        label="Audits"
        named-route="Audits"
      />
    </div>
    <div class="flex-1 bg-blue-50">
      <div>
        <Navbar
          :is-showing-notification-widget="isShowingNotificationWidget"
          @toggleNotificationWidget="toggleNotificationWidget"
        />
      </div>
      <div>
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
import SidebarLink from "@/components/common/SidebarLink"
import Navbar from "@/components/layout-components/Navbar"
import NotificationWidget from "@/components/notification/NotificationWidget"

export default {
  name: 'AppLayout',

  components: {
    SidebarLink,
    Navbar,
    NotificationWidget,
  },

  data() {
    return {
      isShowingNotificationWidget: false,
      isSideBarPinned: true,
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
    },

    sidebarWidth() {
      return this.isSideBarPinned ? 240 : 80
    }
  },

  created() {
    this.$pusher.subscribe('private-invitations' + this.organization.tenant.id)
      .bind('sent', (data) => console.log(data))
      .bind('accept', (data) => this.displayNotifications('success', data.invitation.email + ' is now a member'))
  },

  methods: {
    toggleNotificationWidget() {
      this.isShowingNotificationWidget = !this.isShowingNotificationWidget
    },

    toggleSideBar() {
      this.isSideBarPinned = !this.isSideBarPinned
    },

    displayNotifications(type, text) {
      this.$notify({type, text})
    }
  }
}
</script>

<style scoped>
.sidebar {
  @apply flex;
  @apply flex-col;
  @apply h-screen;
  @apply delay-75;
  @apply bg-gray-900;
  @apply duration-100;
  position: relative;
}
</style>
