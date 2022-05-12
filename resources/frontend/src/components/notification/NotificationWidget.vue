<template>
  <div
    aria-live="assertive"
    class="fixed inset-0 flex items-end px-4 pointer-events-none sm:p-6 sm:items-start h-4/3"
  >
    <div class="w-full flex flex-col items-center space-y-4 sm:items-end">
      <transition
        enter-active-class="transform ease-out duration-300 transition"
        enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
        enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
        leave-active-class="transition ease-in duration-100"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
      >
        <div
          v-if="isShowingNotificationWidget"
          class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden"
        >
          <div
            v-if="notifications.length"
            class="p-4"
          >
            <div class="flex justify-between text-xs">
              <div>You have {{ notifications.length }} notifications</div>
              <div>
                <svg-icon
                  icon="close"
                  class="cursor-pointer"
                  @click="$emit('toggleNotificationWidget')"
                />
              </div>
            </div>
            <ul
              role="list"
            >
              <li
                v-for="notification in chunkedNotifications[selectedChunkedNotificationIndex]"
                :key="notification.id"
                class="relative bg-white py-2 px-4 hover:bg-blue-50 cursor-pointer"
              >
                <div class="flex justify-between space-x-3">
                  <div class="min-w-0 flex-1">
                    <p class="text-sm font-bold text-gray-900 truncate">
                      {{ notification.subject }}
                    </p>
                  </div>
                  <time
                    class="flex-shrink-0 whitespace-nowrap text-xs text-gray-400"
                  >{{ notification.time }}</time>
                </div>
                <div class="mt-1">
                  <p class="line-clamp-2 text-xs text-gray-500">
                    {{ notification.preview }}
                  </p>
                </div>
              </li>
            </ul>
            <div class="flex justify-between pt-0.5">
              <button
                type="button"
                :disabled="!hasPreviousChunkedNotificationsCollection"
                :class="[hasPreviousChunkedNotificationsCollection ? activeStyles: disabledStyles]"
                @click="selectedChunkedNotificationIndex --"
              >
                <div class="flex items-center text-xs">
                  <svg-icon icon="previous" /> Previous
                </div>
              </button>
              <button
                type="button"
                :disabled="!hasNextChunkedNotificationsCollection"
                :class="[hasNextChunkedNotificationsCollection ? activeStyles : disabledStyles]"
                @click="selectedChunkedNotificationIndex ++"
              >
                <div class="flex items-center text-xs">
                  Next <svg-icon icon="next" />
                </div>
              </button>
            </div>
          </div>

          <div
            v-else
            class="p-4"
          >
            <div class="flex justify-between">
              <div>You have no notifications</div>
              <div>
                <svg-icon
                  icon="close"
                  class="cursor-pointer"
                  @click="$emit('toggleNotificationWidget')"
                />
              </div>
            </div>
          </div>
        </div>
      </transition>
    </div>
  </div>
</template>

<script>
import {chunk} from "lodash"

export default {
  name: "NotificationWidget",

  props: {
    isShowingNotificationWidget: {
      type: Boolean,
      required: true,
    },

    notifications: {
      type: Array,
      default: () => [],
    },
  },

  data() {
    return {
      selectedChunkedNotificationIndex: 0,
      activeStyles:['text-gray-900', 'cursor-pointer'],
      disabledStyles:['text-gray-400', 'cursor-not-allowed'],
    }
  },

  computed: {
    chunkedNotifications() {
      return chunk(this.notifications, 5)
    },

    hasNextChunkedNotificationsCollection() {
      return this.selectedChunkedNotificationIndex !== this.chunkedNotifications.length - 1
    },

    hasPreviousChunkedNotificationsCollection() {
      return this.selectedChunkedNotificationIndex !== 0
    }
  },
}
</script>
