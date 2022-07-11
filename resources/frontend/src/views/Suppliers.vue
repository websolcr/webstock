<template>
  <div>
    <title-bar>
      <template #title>
        Suppliers
      </template>
      <template #top-buttons>
        <push-button
          icon="plus"
          tooltip="Add"
          :is-active="isShowingAddSupplierWidget"
          @click="isShowingAddSupplierWidget = true"
        />

        <push-button
          icon="pencil"
          tooltip="Edit"
          :is-active="isShowingEditSupplierWidget"
          @click="isShowingEditSupplierWidget = true"
        />
      </template>
    </title-bar>

    <suppliers-table
      v-if="!$wait.is('fetch-suppliers')"
      :suppliers="suppliers"
      @select-supplier="selectSupplier"
    />

    <div class="mt-1 w-full flex flex-col p-3">
      <add-supplier-widget
        :supplier="newSupplier"
        :is-showing="isShowingAddSupplierWidget"
        @toggle-add-supplier-widget="toggleAddSupplierWidget"
        @confirm-changes="confirmChanges"
        @save="save"
      />

      <edit-supplier-widget
        :selected-supplier="selectedSupplier"
        :is-showing="isShowingEditSupplierWidget"
        @toggle-edit-supplier-widget="toggleEditSupplierWidget"
        @confirm-changes="confirmChanges"
        @save="save"
      />
    </div>
  </div>
</template>

<script>
import TitleBar from "@/components/common/TitleBar"
import PushButton from "@/components/common/PushButton"
import SuppliersTable from "@/components/suppliers/SuppliersTable"
import AddSupplierWidget from "@/components/suppliers/AddSupplierWidget"
import EditSupplierWidget from "@/components/suppliers/EditSupplierWidget"

export default {
  name: "SuppliersPage",

  components: {
    EditSupplierWidget,
    SuppliersTable,
    AddSupplierWidget,
    PushButton,
    TitleBar
  },

  data() {
    return {
      isShowingAddSupplierWidget: false,
      suppliers: [],
      selectedSupplier: {},
      isShowingEditSupplierWidget: false,
      newSupplier: {
        name: '',
        email: '',
        address: '',
        primary_contact_no: '',
        secondary_contact_no: '',
      },
      modifiedSuppliers: [],
      hasUnsavedChanges: false,
      hasNewSupplier: false,
      hasModifiedSuppliers: false,
    }
  },

  created() {
    this.fetchSuppliers()
  },

  methods: {
    closeAddSupplierWidget(){
      this.newSupplier = {}
      this.hasNewSupplier = false
      this.isShowingAddSupplierWidget = false
    },

    closeEditSupplierWidget() {
      this.modifiedSuppliers = []
      this.hasModifiedSuppliers = false
      this.selectedSupplier = {}
      this.isShowingEditSupplierWidget = false
    },

    async saveNewSupplier() {
      try {
        await this.$http.post('suppliers', {...this.newSupplier})

        this.closeAddSupplierWidget()

      }catch (errors) {
        this.notifyErrors(errors)
      }
    },

    async saveModifiedSuppliers() {
      try {
        await this.$http.put('suppliers', {modifiedSuppliers: {...this.modifiedSuppliers}})

        this.closeEditSupplierWidget()

      }catch (errors) {
        this.notifyErrors(errors)
      }
    },

    async save() {
      this.$wait.start('save-supplier')

      if (this.hasNewSupplier) {
        await this.saveNewSupplier()
      }

      if (this.hasModifiedSuppliers) {
        await this.saveModifiedSuppliers()
      }

      if (!this.hasNewSupplier && !this.hasModifiedSuppliers) {
        this.hasUnsavedChanges = false
      }

      this.$wait.end('save-supplier')

      this.fetchSuppliers()
    },

    toggleEditSupplierWidget() {
      if (this.hasModifiedSuppliers) {
        alert('There is unsaved modified suppliers')

        return
      }
      this.isShowingEditSupplierWidget = !this.isShowingEditSupplierWidget
    },

    selectSupplier(supplier) {
      this.selectedSupplier = {...supplier}
    },

    confirmChanges(supplier) {
      this.hasUnsavedChanges = true

      if (!supplier.id) {
        this.hasNewSupplier = true

        this.suppliers = this.updateOrInsert([...this.suppliers], {...supplier})

        this.newSupplier = {...supplier}

        return
      }

      this.selectedSupplier = {...supplier}
      this.hasModifiedSuppliers = true

      this.updateModifiedSuppliersList(supplier)

      this.updateExistingSuppliersListWithModifiedSupplier(supplier)
    },

    updateExistingSuppliersListWithModifiedSupplier(supplier) {
      this.suppliers = this.suppliers.map(originalSupplier => {
        return originalSupplier.id === supplier.id ? supplier : originalSupplier
      })
    },

    updateModifiedSuppliersList(supplier) {
      this.modifiedSuppliers = this.updateOrInsert([...this.modifiedSuppliers], {...supplier})
    },

    updateOrInsert([...inputArray], {...object}, findBy = 'id') {
      if (!inputArray.some(elementOfInputArray => object[findBy] === elementOfInputArray[findBy])) {
        return  inputArray = [...inputArray, object]
      }

      return inputArray.map(elementOfInputArray => {
        return elementOfInputArray[findBy] === object[findBy] ? object : elementOfInputArray
      })
    },

    async fetchSuppliers() {
      this.$wait.start('fetch-suppliers')

      const {data} = await this.$http.get('suppliers')

      this.suppliers = data

      this.$wait.end('fetch-suppliers')
    },

    toggleAddSupplierWidget() {
      if (this.hasNewSupplier) {
        alert('There is unsaved new supplier')

        return
      }

      this.isShowingAddSupplierWidget = !this.isShowingAddSupplierWidget
    },

    notifyErrors(errors) {
      if (errors.response.status === 422){
        Object.entries(errors.response.data.errors).forEach(error =>
          this.$notify({ type: 'error', title: error[0], text: error[1][0]})
        )

        return
      }

      this.$notify({ type: 'error', text: errors.response.data.message })
    }
  }
}
</script>
