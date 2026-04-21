<template>
    <button v-if="label" :class="style_type">{{ label }}</button>
    <button v-else :class="style_type"><slot/></button>
</template>

<script setup>
defineProps({
    label: {
        type: String,
        required: false
    },
    style_type: {
        type: String,
        required: false,
        default: ''
    },
});
</script>

<style scoped>
button{
    all:unset;
    cursor: pointer;
    padding:10px 20px;
    background-color: var(--button-bg);
    border-radius: var(--btn-border-radius);
    font-size: 16px;
    font-family: Inter, "Inter Fallback", sans-serif;
    font-feature-settings: normal;
    font-weight: 600;
    user-select: none;
    &:disabled{
        opacity: 0.5;
    }
}
button:not(:disabled):hover{
    background-color: var(--button-bg-hover);
}
button:not(:disabled):active{
    background-color: var(--button-bg);
}
.icon{
    padding:unset
}
.danger{
    border: 1px solid red;
    background: unset
}
</style>
