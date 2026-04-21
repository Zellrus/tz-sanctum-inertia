<template>
  <div @click="toggleDropdown" class="dropdown" ref="selectWrapper">
    <div>
      <slot v-if="!isArrow" name="default" />
      <span v-else class="dropdown_btn" :style="buttonStyles" :aria-expanded="isOpen.toString()">
        <slot name="default" /><Arrow :is-rotate="isOpen" :width="ArrowSize" :height="ArrowSize"/>
      </span>
    </div>
        <transition
        name="dropdown"
        @enter="enter"
        @after-enter="afterEnter"
        @leave="leave"
    >
    <div class="options-wrapper" :class="[type, {'full_width': isFullWidth}]" v-if="isOpen">
      <slot name="dropdown" />
    </div>
    </transition>
  </div>
</template>

<script setup>
import {useDropdown} from '@/composables/useDropdown'
import Arrow from "@/Components/Base/Arrow.vue";
import {watch} from "vue";
const props = defineProps({
  type: {
    type: String,
    default: 'down',
  },
  isFullWidth:{
    type:Boolean,
    required:false
  },
  isOpenProp: {
    type: Boolean,
  },
  isArrow:{
    type: Boolean,
  },
  ArrowSize:{
    type:String,
  },
  buttonStyles:{
    type: String,
    default: ''
  }
})


const {
  isOpen,
  selectWrapper,
  enter,
  afterEnter,
  leave,
  handleClickOutside,
} = useDropdown()

const emit = defineEmits(['change'])
function toggleDropdown() {
  isOpen.value = !isOpen.value
  if (isOpen.value) {
    document.addEventListener('click', handleClickOutside)
  }
  emit('change', isOpen.value)
}

watch(() => props.isOpenProp, () => {
  isOpen.value = false
  emit('change', false)
})

</script>

<style scoped>
.dropdown{
  position: relative;
}
.options-wrapper{
  position: absolute;

  background-color: var(--block-bg-color);
  /* border:1px solid rgba(225, 226, 255, 1); */
  width: max-content;
  border-radius: var(--btn-border-radius);
   box-shadow: var(--block-box-shadow);

}
.options-wrapper.up{
  bottom: 100%;
  left: 0;
  right: 0;
  z-index: 1;
}
.options-wrapper.down{
  top: 100%;
  left: 0;
  right: 0;
  z-index: 1;
}
.full_width{
  width: 100%;
}
.dropdown_btn{
  display: flex;
  align-items: center;
  gap: 5px;
}
/*.dropdown_btn:not(:disabled):hover{*/
/*  background-color: var(--button-bg-hover);*/
/*}*/
/*.dropdown_btn:not(:disabled):active{*/
/*  background-color: var(--button-bg);*/
/*}*/

</style>
