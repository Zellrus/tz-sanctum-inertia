<template>
  <div class="field-container">
    <label v-if="label" :for="id" class="input-label">{{ label }}</label>
    <Dropdown
        @change="a => isOpen = a"
        :isFullWidth="true"
        :isOpenProp="isOpenProp"
    >
      <div :class="['select-field field', { 'field-error': errors.length >0 }]">
      <p>{{ selected??def }}</p>
        <Arrow :isRotate="isOpen" />
      </div>
      <template #dropdown>
        <ul class="options">
          <li v-for="option in options" @click="select(option)">
         {{option.name || option}}
          </li>
        </ul>
      </template>
    </Dropdown>
    <span v-for="error in errors" class="error-message">{{error}}</span>
  </div>
</template>
<script setup>
import Dropdown from "@/Components/Base/Dropdown.vue";
import Arrow from "@/Components/Base/Arrow.vue";
import {ref, watch} from "vue";
const props = defineProps({
  label: {
    type: String,
    default: '',
  },
  def:{
    type: String,
  },
  id: {
    type: String,
    default: () => `select-${Math.random().toString(36).substring(2, 9)}`,
  },
    options: {
        type: Array,
    },
    selected:{ default: null},
  errors: {
    type: Array,
    default: [],
  }
})
const isOpen = ref(false);
const selected = ref(props.selected);
const isOpenProp = ref();

const emit = defineEmits(['selected']);
function select(option) {
  selected.value = option.name || option;
  emit('selected', option);
  isOpenProp.value = !isOpenProp.value;
}

watch(() => props.selected, (newVal) => {
    if (newVal === null) {
        selected.value = null
    }
})
</script>
<style scoped>

.select-field{
  padding: 5px 10px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  cursor: pointer;
}
.options{
  list-style: none;
  margin: 0;
  padding: 0;
  width: 100%;
  color: var(--text-color);
  max-height: 200px;
  overflow-y: auto;
}
.options li{
  padding: 8px 12px;
  cursor: pointer;
  border-bottom: 1px solid var(--input-bg);
}
.options li:hover{
  background-color: rgba(201, 199, 200, 0.288);
}
.options li:first-child{
  border-radius: 12px 12px 0 0;
}
.options li:last-child{
  border-bottom: none;
  border-radius: 0 0 12px 12px;
}
</style>
