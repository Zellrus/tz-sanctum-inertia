<template>
  <div class="field-container">
    <label v-if="label" :for="id" class="textarea-label">{{ label }}</label>
    <textarea
        v-bind="textareaAttrs"
        :id="id"
        :placeholder="placeholder"
        :value="modelValue"
        @input="updateValue"
        :class="['textarea-field field', textareaClass, { 'field-error': errors.length >0  }]"
    ></textarea>
    <span v-for="error in errors" class="error-message">{{error}}</span>
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
    default: () => `textarea-${Math.random().toString(36).substring(2, 9)}`,
  },
  placeholder: {
    type: String,
    default: '',
  },
  errors: {
    type: Array,
    default: [],
  },
  textareaClass: {
    type: String,
    default: '',
  },
  textareaAttrs: {
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

.textarea-field {
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  padding:10px;
  resize: none;
}
.textarea-field:focus{
  outline: 1px solid rgb(108, 188, 171);
}

</style>
