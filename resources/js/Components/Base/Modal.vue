<template>
  <Teleport to="body">
    <div :class="['modal-backdrop', position]" @click.self="outsideClick" >
      <div class="modal-container">
        <div class="modal-header">
          <h4 class="uppercase" >{{ title }}</h4>
          <button class="close-btn" @click="close">✕</button>
        </div>
        <Suspense>
          <template #default>
            <div class="modal-body">
          <slot />
        </div>
        </template>
          <template #fallback>
            <LoadingSpinner />
          </template>
        </Suspense>
      </div>
    </div>
  </Teleport>
</template>

<script setup lang="ts">
import { onMounted, onBeforeUnmount } from 'vue'
import LoadingSpinner from '@/Components/LoadingSpinner.vue'
const emit = defineEmits(['close'])

const props = defineProps({
  title: {
    required: false,
    type: String
  },
  isModalCloseOnOutsideClick:{
    type: Boolean,
  },
  position: {
    type: String,
    default: 'center'
  }
})
function outsideClick(){
  if (!props.isModalCloseOnOutsideClick) return 0
  emit('close')
}
function close() {
  emit('close')
}


let originalOverflow = ''
let originalPaddingRight = ''

onMounted(() => {
  const scrollbarWidth =
      window.innerWidth - document.documentElement.clientWidth

  originalOverflow = document.body.style.overflow
  originalPaddingRight = document.body.style.paddingRight

  document.body.style.overflow = 'hidden'

  if (scrollbarWidth > 0) {
    document.body.style.paddingRight = `${scrollbarWidth}px`
  }
})

onBeforeUnmount(() => {
  document.body.style.overflow = originalOverflow
  document.body.style.paddingRight = originalPaddingRight
})

</script>

<style scoped>
h4{
  margin: 10px 0;
}
.modal-backdrop {
  position: fixed;
  inset: 0;
  z-index: 9999;
  background: rgba(0, 0, 0, 0.1);
}
.modal-backdrop.center{
  display: flex;
  align-items: center;
  justify-content: center;
}
.modal-container {
  border-radius: 12px;
  max-width: 650px;
  width: 90%;
  border: 0;
  box-shadow: var(--block-box-shadow);
  color:var(--text-color);
  padding: 20px;
  background:var( --block-bg-color);
  max-height: calc(100vh - var(--header-height));
  overflow: auto;
}

.modal-backdrop.margin-top .modal-container{
  justify-self: center;
  margin-top: calc(25vh - var(--header-height));
  max-width: 700px;
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 12px;
}

.close-btn {
  background: none;
  border: none;
  font-size: 20px;
  cursor: pointer;
  color:var(--text-color)
}

@media (max-width: 768px) {
  .modal-container {
    max-height: unset;
    width: 100%;
    height: 100%;
    border-radius:0;
  }
  .modal-backdrop.margin-top .modal-container{
    margin-top: unset;
  }
}

</style>
