<template>
  <div>
    <title-bar>
      <template #title>
        Home Page
      </template>

      <template #top-buttons>
        <div class="space-x-2">
          <push-button
            icon="plus"
            tooltip="add"
          />
          <push-button
            icon="pencil"
            tooltip="edit"
            :is-active="isShowingEditWidget"
            @click="toggleEditWidget"
          />
          <push-button
            icon="info"
            tooltip="info"
          />
        </div>
      </template>
    </title-bar>

    <div class="mt-1 w-full flex flex-col p-3">
      home page content goes here
    </div>
  </div>
</template>

<script>
import TitleBar from "@/components/common/TitleBar"
import PushButton from "@/components/common/PushButton"

export default {
  name: "DashboardComponent",

  components: {
    TitleBar,
    PushButton,
  },

  data() {
    return{
      isShowingEditWidget: false,
      email: '',
      organization: [],
    }
  },

  methods: {
    toggleEditWidget() {
      this.isShowingEditWidget = !this.isShowingEditWidget
    },
  }
}
</script>
