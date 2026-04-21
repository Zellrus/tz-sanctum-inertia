<template>
    <svg class="arrow" :class="{ 'arrow-down': !isRotate, 'arrow-up': isRotate }" :width="width" :height="height" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M6 12L15.79 21.79C16.18 22.18 16.81 22.18 17.2 21.79L27 12" stroke="currentColor" stroke-width="1.5"/>
    </svg>
</template>
<script setup lang="ts">
defineProps({
    isRotate:{
        type: Boolean,
        required: true
    },
    height: {
        type: String,
        default: '25px'
    },
    width: {
        type: String,
        default: '25px'
    },
})
</script>
<style scoped>
.arrow {
    transition: transform 0.3s ease;
}
.arrow.arrow-down {
    transform: rotate(0deg);
}

.arrow.arrow-up {
    transform: rotate(180deg);
}
</style>
