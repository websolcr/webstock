<template>
  <div>
    <plus-icon v-if="icon === 'plus'" />
    <bell-icon v-if="icon === 'bell'" />
    <close-icon v-if="icon === 'close'" />
    <pencil-icon v-if="icon === 'pencil'" />
    <logout-icon v-if="icon === 'logout'" />
    <information-icon v-if="icon === 'info'" />
    <documents-icon v-if="icon === 'document'" />
    <chevron-down v-if="icon === 'chevron-down'" />
    <chevron-up v-if="icon === 'chevron-up'" />
    <tick v-if="icon === 'tick'" />
    <ticket-icon v-if="icon === 'ticket'" />
    <filter-icon v-if="icon === 'filter'" />
    <right-arrow v-if="icon === 'rightArrow' || icon === 'next' || icon === 'right'" />
    <left-arrow v-if="icon === 'leftArrow' || icon === 'previous' || icon === 'left'" />
  </div>
</template>

<script>
import PlusIcon from "@/components/common/svg-icon/PlusIcon"
import BellIcon from "@/components/common/svg-icon/BellIcon"
import CloseIcon from "@/components/common/svg-icon/CloseIcon"
import LeftArrow from "@/components/common/svg-icon/LeftArrow"
import RightArrow from "@/components/common/svg-icon/RightArrow"
import LogoutIcon from "@/components/common/svg-icon/LogoutIcon"
import PencilIcon from "@/components/common/svg-icon/PencilIcon"
import DocumentsIcon from "@/components/common/svg-icon/DocumentsIcon"
import InformationIcon from "@/components/common/svg-icon/InformationIcon"
import ChevronDown from "@/components/common/svg-icon/ChevronDown"
import ChevronUp from "@/components/common/svg-icon/ChevronUp"
import Tick from "@/components/common/svg-icon/Tick"
import TicketIcon from "@/components/common/svg-icon/TicketIcon"
import FilterIcon from "@/components/common/svg-icon/FilterIcon"

export default {
  name: 'SvgIcon',

  components: {
    FilterIcon,
    TicketIcon,
    Tick,
    ChevronDown,
    ChevronUp,
    DocumentsIcon,
    InformationIcon,
    PencilIcon,
    PlusIcon,
    LogoutIcon,
    RightArrow,
    LeftArrow,
    BellIcon,
    CloseIcon
  },

  props: {
    icon: {
      type: String,
      required: true,
    },
  }
}
</script>
