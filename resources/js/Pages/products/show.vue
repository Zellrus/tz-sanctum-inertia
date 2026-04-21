<template>
    <Head :title="product.name" />
    <AppLayout>
<main>
    <Button @click="goBack" label="Назад" style="place-self: flex-start;" />
   <span>ID:{{product.id}}</span>
   <span>Название:{{product.name}}</span>
   <span>Категория:{{product.category.name}}</span>
   <span>Цена:{{product.price}}</span>
   <span>Создан:{{created_at}}</span>
   <span>Обновлён:{{updated_at}}</span>
</main>
    </AppLayout>
</template>
<script setup lang="ts">
import { Head } from '@inertiajs/vue3'
import {Product} from "@/Types/product";
import AppLayout from "../../Layouts/AppLayout.vue";
import {computed} from "vue";
import Button from "@/Components/Inputs/Button.vue";


const props = defineProps<{
    product: Product
}>()

const created_at = computed(() => new Date(props.product.created_at));
const updated_at = computed(() => new Date(props.product.updated_at));

function goBack() {
    window.history.back(); // возвращает на предыдущую страницу
}
</script>
<style scoped>
main{
    display: flex;
    flex-direction: column;
    gap:10px;
    padding:10px;
    margin: var(--global-margin);
}
</style>
