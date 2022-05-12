<template>
  <div>
    <title-bar>
      <template #title>
        User Management
      </template>
      <template #top-buttons>
        <push-button
          icon="plus"
          tooltip="Invite"
          :is-active="isShowingSendInvitationWidget"
          @click="toggleSendInvitationWidget"
        />
      </template>
    </title-bar>

    <div class="mt-1 w-full flex flex-col p-3">
      <send-invitation-widget
        :is-showing="isShowingSendInvitationWidget"
        @toggle-send-invitation-widget="toggleSendInvitationWidget"
      />
    </div>
  </div>
</template>

<script>
import TitleBar from "@/components/common/TitleBar"
import PushButton from "@/components/common/PushButton"
import SendInvitationWidget from "@/components/user-management/SendInvitationWidget"

export default {
  name: "InvitationSend",

  components: {
    SendInvitationWidget,
    PushButton,
    TitleBar
  },

  data() {
    return {
      email: '',
      isShowingSendInvitationWidget: false,
    }
  },

  methods: {
    toggleSendInvitationWidget() {
      this.isShowingSendInvitationWidget = !this.isShowingSendInvitationWidget
    }
  }
}
</script>
