<template>
  <div
    is="nav"
    class="bg-indigo-500 shadow flex justify-between h-16 px-2 items-center"
  >
    <div>
      <h3 class="text-sm font-bold text-white">
        {{ organization.tenant.name }}
      </h3>
    </div>
    <div>
      <div class="flex gap-2">
        <div class="text-sm text-white">
          {{ user.name }}
        </div>
        <div>
          <bell-icon
            class="h-6 w-6 text-white cursor-pointer"
            aria-hidden="true"
          />
        </div>
        <div>
          <logout-icon
            class="h-6 w-6 text-white cursor-pointer"
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
