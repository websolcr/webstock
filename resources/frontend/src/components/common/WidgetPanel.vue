<!--delete this example component after you create your first widget. this is an sample-->
<template>
  <TransitionRoot
    :show="isShowing"
  >
    <Dialog
      as="div"
      class="relative"
    >
      <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-y-scroll">
          <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
            <TransitionChild
              as="template"
              enter="transform transition ease-in-out duration-500 sm:duration-700"
              enter-from="translate-x-full"
              enter-to="translate-x-0"
              leave="transform transition ease-in-out duration-500 sm:duration-700"
              leave-from="translate-x-0"
              leave-to="translate-x-full"
            >
              <DialogPanel class="pointer-events-auto w-screen max-w-md">
                <div class="flex flex-col divide-y divide-gray-200 bg-white shadow-xl widget-styles">
                  <div class="h-0 flex-1 overflow-y-auto">
                    <div class="py-4 px-4">
                      <div class="mt-1 flex justify-between bg-blue-50 p-2">
                        <p class="text-sm">
                          <slot name="header" />
                        </p>
                        <svg-icon
                          icon="close"
                          class="cursor-pointer"
                          @click="$emit('close')"
                        />
                      </div>
                    </div>
                    <div class="flex flex-1 flex-col justify-between px-3">
                      <slot name="body" />
                    </div>
                  </div>
                  <div class="flex flex-shrink-0 justify-between px-4 py-4">
                    <slot name="footer" />
                  </div>
                </div>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script>
import { Dialog, DialogPanel, TransitionChild, TransitionRoot } from '@headlessui/vue'

export default {
  name: 'WidgetPanel',

  components: {
    Dialog,
    DialogPanel,
    TransitionRoot,
    TransitionChild,
  },

  props: {
    isShowing: {
      type: Boolean,
      default: false,
    }
  },
}
</script>

<style scoped>
.widget-styles{
  margin-top: 120px;
  height: calc(100vh - 128px);
}
</style>
