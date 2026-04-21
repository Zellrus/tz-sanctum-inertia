<template>
  <div class="field-container">
    <label v-if="label" :for="id" class="input-label">{{ label }}</label>
    <Dropdown
        @change="a => isOpen = a"
        :isFullWidth="true"
        :isOpenProp="isOpenProp"
    >
      <div :class="['select-field field', { 'field-error': errors.length >0 }]">
      <template v-if="!translate"><p>{{ selected??def }}</p></template>
      <template v-else>{{selected ?  $t(`${translate+selected}`) : def}}</template>
        <Arrow :isRotate="isOpen" />
      </div>
      <template #dropdown>
        <ul class="options">
          <li v-for="option in options" @click="select(option)">
         <template v-if="!translate">{{option.name || option}}</template>
         <template v-else>{{option.name ?  $t(`${translate+option.name}`) : $t(translate+option)}}</template>
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
import {ref} from "vue";
defineProps({
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
  errors: {
    type: Array,
    default: [],
  },
  translate:{
    type: String,
  }
})
const isOpen = ref(false);
const selected = ref();
const isOpenProp = ref();

const emit = defineEmits(['selected']);
function select(option) {
  selected.value = option.name || option;
  emit('selected', option);
  isOpenProp.value = !isOpenProp.value;
}
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
