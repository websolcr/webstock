<template>
  <div
    is="nav"
    class="bg-indigo-500 shadow flex justify-between h-16 px-6 items-center"
  >
    <div class="flex gap-3">
      <div class="text-3xl font-bold text-white">
        {{ organization.tenant.name }} |
      </div>
      <div class="text-sm bg-red-300 flex items-end">
        <span class="align-bottom">
          <router-link
            :to="{name: 'OrganizationIndex'}"
            class="text-white"
          >
            Your Organizations
          </router-link>
        </span>
      </div>
    </div>

    <div>
      <div class="flex gap-6">
        <div class="text-sm text-white">
          {{ user.name }}
        </div>
        <div>
          <svg-icon
            v-tooltip="'notifications'"
            icon="bell"
            class="text-white cursor-pointer"
            @click="$emit('toggleNotificationWidget')"
          />
        </div>
        <div>
          <svg-icon
            v-tooltip="'logout'"
            icon="logout"
            class="text-white cursor-pointer"
            @click="logout"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: 'NavBar',

  props: {
    isShowingNotificationWidget: {
      type: Boolean,
      required: true,
    }
  },

  computed: {
    organization() {
      return this.$store.state.tenancy
    },
    user() {
      return this.$store.state.user
    },
  },

  methods: {
    logout() {
      this.clearLocalStorage()

      const form = document.getElementById('logout-form')
      form.submit()
    },
    clearLocalStorage() {
      localStorage.removeItem('user')
      localStorage.removeItem('tenancy')
    },
  },
}
</script>
