<template>
  <div class="field-container">
  <label v-if="label" :for="id" class="input-label">{{ label }}</label>
  <input
      v-bind="inputAttrs"
      :id="id"
      :type="type"
      :placeholder="placeholder"
      :value="modelValue"
      @input="updateValue"
      :class="['input-field field', inputClass, { 'field-error': errors.length >0  }]">
    <span v-for="error in errors" class="error-message">{{error}}</span>
<!--    <span v-if="errors.length >= 0 " class="error-message">{{errors}}</span>-->
  </div>

</template>
<script setup>
defineProps({
  modelValue: {
    type: [String, Number],
    default: '',
  },
  label: {
    type: String,
    default: '',
  },
  id: {
    type: String,
    default: () => `input-${Math.random().toString(36).substring(2, 9)}`,
  },
  type: {
    type: String,
    default: 'text',
  },
  placeholder: {
    type: String,
    default: '',
  },
  errors: {
    type: Array,
    default: [],
  },
  inputClass: {
    type: String,
    default: '',
  },
  inputAttrs: {
    type: Object,
    default: () => ({}),
  },
})
const emit = defineEmits( ['update:modelValue'])
const updateValue = (event) => {
  emit('update:modelValue', event.target.value);
};

</script>
<style scoped>

.input-field {
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  padding: 0 10px;
  height: 36px;
}

.input-field:focus{
  outline: 1px solid rgb(108, 188, 171);
}

</style>
