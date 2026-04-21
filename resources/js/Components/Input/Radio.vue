<template>
    <div class="radio-wrapper">
        <input
            :id="`${title}-${id}`"
            class="radio"
            type="radio"
            :name="name"
            :value="id"
            :checked="modelValue === id"
            @change="$emit('update:modelValue', id)"
        />
        <label :for="`${title}-${id}`" class="custom-radio">
            <svg
                v-if="modelValue === id"
                class="dot"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
            >
                <circle stroke="currentColor" cx="12" cy="12" r="6" fill="currentColor" />
            </svg>
        </label>
        <span @click.prevent="$emit('update:modelValue', id)" class="label">
      {{ title }}
    </span>
    </div>
</template>

<script setup>
defineProps({
    id: [String, Number],
    title: String,
    name: String,
    modelValue: [String, Number],
})

</script>

<style scoped>
.radio-wrapper {
    display: flex;
    align-items: center;
    cursor: pointer;
    position: relative;
}

.radio {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.custom-radio {
    position: relative;
    width: 25px;
    height: 25px;
    border-radius: 50%;
    border: 1px solid #76757a;
    margin-right: 0.5rem;
    cursor: pointer;
    flex-shrink: 0;
    display: flex;
    justify-content: center;
    align-items: center;
}

.custom-radio svg {
    width: 14px;
    height: 14px;
}

.label {
    color: var(--text-color);
    user-select: none;
    text-align: left;
    font-family: Inter, "Inter Fallback", sans-serif;
    font-size: 16px;
}
</style>
