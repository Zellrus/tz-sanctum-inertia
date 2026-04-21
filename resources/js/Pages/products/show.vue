<template>
    <AppLayout>
<div>
    {{product}}
</div>
    </AppLayout>
</template>
<script setup lang="ts">
import {Product} from "../../Types/product";
import AppLayout from "../../Layouts/AppLayout.vue";

defineProps<{
    product: Product
}>()
</script>
<style scoped>

</style>
