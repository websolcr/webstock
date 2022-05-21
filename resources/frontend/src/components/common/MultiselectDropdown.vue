<template>
  <div>
    <div
      v-tooltip="selectedItemListPreview ?? ''"
      class="px-4 py-2 bg-white text-blue-900 border border-blue-200 rounded-lg shadow items-center justify-between dropdown-button-width active:border-blue-600 hover:border-blue-600 cursor-pointer"
      @click="toggle"
    >
      <div class="uppercase font-bold text-sm">
        <div class="flex gap-3 justify-between">
          {{ buttonText }}
          <svg-icon :icon="isExpand ? 'chevron-up' : 'chevron-down'" />
        </div>
      </div>
      <div
        v-if="selectedItemListPreview"
        class="truncate text-blue-600 text-xs"
      >
        {{ selectedItemListPreview }}
      </div>
    </div>

    <div
      v-if="isExpand"
      class="flex flex-col bg-white text-sm text-blue-600 w-fit px-4 py-2 rounded-lg border border-blue-400 shadow absolute z-1o"
    >
      <div class="dropdown-menu overflow-y-scroll border-b border-blue-400">
        <div
          v-for="item in items"
          :key="item.id"
          class="flex py-2 cursor-pointer hover:bg-blue-50 hover:rounded gap-3"
          @click="selectOrDeselect(item)"
        >
          <div class="w-5">
            <svg-icon
              v-if="item.isSelectedInDropdown"
              icon="tick"
            />
          </div>{{ item[label] }}
        </div>
      </div>

      <div class="flex items-center justify-between gap-3 mt-2">
        <button @click="clearSelection">
          clear
        </button>
        <button @click="selectAll">
          select all
        </button>
        <base-button
          label="apply filters"
          @click="applySelection"
        />
      </div>
    </div>
  </div>
</template>

<script>
import BaseButton from "@/components/common/BaseButton"

export default {
  name: "MultiselectDropdown",

  components: {
    BaseButton
  },

  props: {
    dataset: {
      type: Array,
      default: () => []
    },

    trackBy: {
      type: String,
      default: () => 'id'
    },

    label: {
      type: String,
      required: true,
    },

    buttonText: {
      type: String,
      required: true,
    },
  },

  data() {
    return {
      isExpand: false,
      items: [],
      preSelectedItems: [],
    }
  },

  computed: {
    selectedItems() {
      return [...this.items].filter(item => item.isSelectedInDropdown === true)
    },

    selectedItemListPreview() {
      return this.selectedItems
        .map(isSelectedInDropdownItem => isSelectedInDropdownItem[this.label])
        .join(', ')
    },
  },

  watch: {
    dataset: {
      immediate: true,
      deep: true,
      handler() {
        this.items = [...this.dataset].map(dataItem => {
          return {
            ...dataItem,
            id: dataItem[this.trackBy],
            isSelectedInDropdown: this.currentlySelectedItemIds().includes(dataItem[this.trackBy])
          }
        })
      },
    },
  },

  methods: {
    toggle() {
      this.items = [...this.dataset].map(dataItem => {
        return {
          ...dataItem,
          id: dataItem[this.trackBy],
          isSelectedInDropdown: this.preSelectedItemIds().includes(dataItem[this.trackBy])
        }
      })

      this.isExpand = !this.isExpand
    },

    getListOfIds(arrayOfObjects) {
      return arrayOfObjects.map(item => item.id)
    },

    currentlySelectedItemIds() {
      return this.getListOfIds(this.selectedItems)
    },

    preSelectedItemIds() {
      return this.getListOfIds(this.preSelectedItems)
    },

    selectOrDeselect(selectedItem) {
      this.items = [...this.items].map(originalItem => {
        return originalItem.id !== selectedItem.id ?
          originalItem : {...selectedItem,
            isSelectedInDropdown: !selectedItem.isSelectedInDropdown
          }
      })
    },

    setAsSelected(item) {
      return {
        ...item,
        isSelectedInDropdown: true
      }
    },

    setAsNotSelected(item) {
      return {
        ...item,
        isSelectedInDropdown: false
      }
    },

    selectAll() {
      this.items = [...this.items].map(this.setAsSelected)
    },

    clearSelection() {
      this.items = [...this.items].map(this.setAsNotSelected)
    },

    applySelection() {
      this.preSelectedItems = [...this.selectedItems]

      this.$emit('update:modelValue', [...this.selectedItems])

      this.isExpand = !this.isExpand
    }
  }

}
</script>

<style scoped>
.dropdown-button-width{
  max-width: 140px;
}

.dropdown-menu {
  max-height: 600px;
}
</style>
