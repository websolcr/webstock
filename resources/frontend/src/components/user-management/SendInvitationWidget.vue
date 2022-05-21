<template>
  <widget-panel
    :is-showing="isShowing"
    @close="$emit('toggleSendInvitationWidget')"
  >
    <template #header>
      Invite new Member
    </template>

    <template #body>
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
          console.log(response)
          if (response.status === 204) {
            this.form = {
              email_to: ''
            }

            this.$wait.end('send-invitation')

            this.$notify({ type: 'success', text: 'Invitation was sent successfully' })

            this.$emit('toggleSendInvitationWidget')
          }
        }).catch(errors => {
          if (errors.response.status === 422){
            this.$notify({ type: 'error', title:'Oops', text: 'Oops...y' })
          }

          if (errors.response.status === 500){
            this.$notify({ type: 'error', text: errors.response.data.message })
          }

          this.$wait.end('send-invitation')
        })
    },
  }
}
</script>
