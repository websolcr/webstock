<template>
  <widget-panel
    :is-showing="isShowing"
    @close="closeWidget"
  >
    <template #header>
      Add Supplier
    </template>

    <template #body>
      <add-supplier-form
        :supplier="supplier"
        @confirm-changes="confirmChanges"
        @has-unconfirmed-changes="hasUnconfirmedChanges = $event"
      />
    </template>

    <template #footer>
      <base-button
        :disabled="$wait.is('save-supplier') || hasUnconfirmedChanges"
        label="save"
        @click="$emit('save')"
      />
    </template>
  </widget-panel>
</template>

<script>
import BaseButton from "@/components/common/BaseButton"
import WidgetPanel from "@/components/common/WidgetPanel"
import AddSupplierForm from "@/components/suppliers/AddSupplierWidgetForm"

export default {
  name: 'AddSupplierWidget',

  components: {
    AddSupplierForm,
    BaseButton,
    WidgetPanel
  },

  props: {
    isShowing: {
      type: Boolean,
      default: false,
    },

    supplier: {
      type: Object,
      required: true,
    },
  },

  data() {
    return{
      hasUnconfirmedChanges: false,
    }
  },

  methods: {
    closeWidget() {
      if (!this.hasUnconfirmedChanges) {
        this.$emit('toggle-add-supplier-widget')

        return
      }

      alert('There are unconfirmed changes.')
    },

    confirmChanges(supplier) {
      this.hasUnconfirmedChanges = false

      this.$emit('confirm-changes', supplier)
    },
  }
}
</script>
