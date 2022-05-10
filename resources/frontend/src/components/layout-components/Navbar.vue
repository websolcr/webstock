<template>
  <div
    is="nav"
    class="bg-indigo-500 shadow flex justify-between h-16 px-6 items-center"
  >
    <div>
      <h3 class="text-sm font-bold text-white">
        {{ organization.tenant.name }}
      </h3>
    </div>
    <div>
      <div class="flex gap-6">
        <div class="text-sm text-white">
          {{ user.name }}
        </div>
        <div>
          <bell-icon
            class="h-6 w-6 text-white cursor-pointer hover:border-2 border-transparent rounded-full"
            aria-hidden="true"
            @click="$emit('toggleNotificationWidget')"
          />
        </div>
        <div>
          <logout-icon
            class="h-6 w-6 text-white cursor-pointer hover:border-2 border-transparent rounded-full"
            aria-hidden="true"
            @click="logout"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import BellIcon from '@/components/common/svg-icon/BellIcon'
import LogoutIcon from '@/components/common/svg-icon/LogoutIcon'

export default {
  name: 'NavBar',

  components: {
    BellIcon,
    LogoutIcon,
  },

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
    }
  },
}
</script>
