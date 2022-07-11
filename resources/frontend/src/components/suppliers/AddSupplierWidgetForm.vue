<template>
  <div>
    <base-input
      id="name"
      v-model="form.name"
      label="Name"
      type="text"
    />

    <base-input
      id="email"
      v-model="form.email"
      label="Email"
      type="email"
    />

    <base-input
      id="address"
      v-model="form.address"
      label="Address"
      type="text"
    />

    <base-input
      id="primary_contact_no"
      v-model="form.primary_contact_no"
      label="Contact Number"
      type="text"
    />

    <base-input
      id="secondary_contact_no"
      v-model="form.secondary_contact_no"
      label="Contact Number (optional)"
      type="text"
    />

    <div class="flex justify-between">
      <base-button
        :disabled="!canConfirmChanges"
        label="confirm"
        @click="confirmChanges"
      />

      <base-button
        :disabled="!hasAnyChange"
        label="reset"
        @click="resetChanges"
      />
    </div>
  </div>
</template>

<script>
import BaseInput from "@/components/common/BaseInput"
import BaseButton from "@/components/common/BaseButton"

export default {
  name: "AddSupplierWidgetForm",

  components: {
    BaseButton,
    BaseInput
  },

  props: {
    supplier: {
      type: Object,
      required: true,
    },
  },

  data() {
    return {
      form: {
        name: '',
        email: '',
        address: '',
        primary_contact_no: '',
        secondary_contact_no: '',
      },
    }
  },

  computed: {
    canConfirmChanges() {
      return this.form.name &&
        this.form.email &&
        this.form.address &&
        this.form.primary_contact_no &&
        this.hasAnyChange
    },

    hasAnyChange() {
      return this.form.name !== this.supplier.name ||
        this.form.email !== this.supplier.email ||
        this.form.address !== this.supplier.address ||
        this.form.primary_contact_no !== this.supplier.primary_contact_no ||
        this.form.secondary_contact_no !== this.supplier.secondary_contact_no
    }
  },

  watch: {
    supplier: {
      immediate: true,
      deep: true,
      handler(supplier) {
        this.form = {...supplier}
      },
    },

    canConfirmChanges: {
      handler(canConfirmChanges) {
        this.$emit('has-unconfirmed-changes', canConfirmChanges)
      }
    }
  },

  methods: {
    confirmChanges() {
      this.$emit('confirm-changes', {...this.form})
    },

    resetChanges() {
      this.form = {...this.supplier}
    }
  }
}
</script>
