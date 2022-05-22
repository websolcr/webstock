<template>
  <widget-panel
    :is-showing="isShowing"
    @close="$emit('toggleSendInvitationWidget')"
  >
    <template #header>
      Invite new Member
    </template>

    <template #body>
      <div v-if="Object.keys(errors).length">
        <div
          v-for="error in errors"
          :key="error"
          class="text-red-300 text-xs"
        >
          {{ error[0] }}
        </div>
      </div>
      <base-input
        id="email_to"
        v-model="form.email_to"
        label="Email"
        placeholder="email address"
        type="email"
      />
    </template>

    <template #footer>
      <base-button
        :disabled="isSending"
        label="invite"
        @click="invite"
      />
    </template>
  </widget-panel>
</template>

<script>
import BaseInput from "@/components/common/BaseInput"
import BaseButton from "@/components/common/BaseButton"
import WidgetPanel from "@/components/common/WidgetPanel"

export default {
  name: 'SendInvitationWidget',

  components: {
    BaseButton,
    BaseInput,
    WidgetPanel
  },

  props: {
    isShowing: {
      type: Boolean,
      default: false,
    }
  },

  data() {
    return{
      form: {
        email_to: ''
      },
      errors: [],
    }
  },

  computed: {
    isSending() {
      return this.$wait.is('send-invitation')
    }
  },

  methods: {
    async invite() {
      this.$wait.start('send-invitation')

      await this.$http.post('invitations/store', {email_to: this.form.email_to})
        .then(response => {
          if (response.status === 204) {
            this.$wait.end('send-invitation')
            this.form.email_to = ''
            this.$emit('toggleSendInvitationWidget')
          }
        }).catch(errors => {
          if (errors.response.status === 422){
            this.$wait.end('send-invitation')
            this.errors = errors.response.data.errors
          }

          if (errors.response.status === 500){
            this.$wait.end('send-invitation')
            this.errors[0] = [errors.response.data.message]
          }
        })
    },
  }
}
</script>
