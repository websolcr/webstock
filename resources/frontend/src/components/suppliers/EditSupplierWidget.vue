<template>
  <widget-panel
    :is-showing="isShowing"
    @close="closeWidget"
  >
    <template
      #header
    >
      Edit Supplier
    </template>

    <template #body>
      <add-supplier-form
        v-if="selectedSupplier.id"
        :supplier="selectedSupplier"
        @confirm-changes="confirmChanges"
        @has-unconfirmed-changes="hasUnconfirmedChanges = $event"
      />
      <div v-else>
        No supplier was selected...
      </div>
    </template>

    <template
      v-if="selectedSupplier.id"
      #footer
    >
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
  name: 'EditSupplierWidget',

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

    selectedSupplier: {
      type: Object,
      default: () => {},
    }
  },

  data() {
    return{
      hasUnconfirmedChanges: false,
    }
  },

  computed: {
    isSending() {
      return this.$wait.is('send-invitation')
    },
  },

  methods: {
    closeWidget() {
      if (!this.hasUnconfirmedChanges) {
        this.$emit('toggle-edit-supplier-widget')

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
