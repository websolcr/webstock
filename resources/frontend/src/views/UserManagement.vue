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

    <div class="my-2 mx-4">
      <members-table :members="members" />
    </div>

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
import MembersTable from "@/components/user-management/MembersTable"


export default {
  name: "UserManagement",

  components: {
    SendInvitationWidget,
    PushButton,
    TitleBar,
    MembersTable
  },

  data() {
    return {
      email: '',
      isShowingSendInvitationWidget: false,
      members: [],
    }
  },
  created() {
    this.fetchMembers()
  },

  methods: {
    toggleSendInvitationWidget() {
      this.isShowingSendInvitationWidget = !this.isShowingSendInvitationWidget
    },
    async fetchMembers(){
      this.$wait.start('fetch-members')

      const {data} = await this.$http.get('members')
      this.members = data

      this.$wait.end('fetch-members')
    },
  }
}
</script>
