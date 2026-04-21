<template>
  <div
    class="skeleton"
    :style="{
      height,
      width,
      borderRadius: radius,
      marginBottom: mb
    }"
  ></div>
</template>

<script setup>
defineProps({
  height: {
    type: String,
    default: '16px'
  },
  width: {
    type: String,
    default: '100%'
  },
  mb: {
    type: String,
    default: '0px'
  },
  radius: {
    type: String,
    default: '6px'
  }
})
</script>

<style scoped>
.skeleton {
  position: relative;
  background-color: rgba(255, 255, 255, 0.08);
  backdrop-filter: brightness(1.2);

  overflow: hidden;
  border-radius: inherit;
}

.skeleton::after {
  content: "";
  position: absolute;
  inset: 0;
  transform: translateX(-100%);
  background: linear-gradient(
    90deg,
    transparent,
    var(--skeleton-animate-color),
    transparent
  );
  animation: shimmer 1.4s ease-out infinite;
}

@keyframes shimmer {
  0%   { transform: translateX(-100%); }
  100% { transform: translateX(100%); }
}
</style>
