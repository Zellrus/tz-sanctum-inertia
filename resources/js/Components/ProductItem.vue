<template>
    <Link
        class="item"
        :href="`/products/${item.id}`"
    >
        <div class="item-body">
            <h3 class="title">{{ item.name }}</h3>
            <p class="description">{{item.description}}</p>
            <p class="category" >Category: {{ item.category.name }}</p>
            <p class="price" >Price: {{ item.price }}</p>
        </div>
    </Link>
</template>

<script setup lang="ts">
import {Product} from "@/Types/product";
import {Link} from "@inertiajs/vue3";

defineProps<{
    item: Product
}>()

</script>

<style scoped>
.item{
    height: 100%;
    width: 100%;
    background-color: var(--block-bg-color);
    border-radius: 12px;
    display: flex;
    align-items: center;
    padding: 16px;
    gap:16px;
    font-family:Inter, "Inter Fallback", sans-serif;
    box-shadow: var(--block-box-shadow);
    cursor: pointer;
    position: relative;
}
.item:hover{
    background-color: var(--block-hover-bg-color);
}
.item img{
    width: 96px;
    height: 96px;
}
.item-body{
    display: flex;
    flex-direction: column;
    gap:4px;
}
h3,p{
    all:unset;
}
.title{
    font-size: 16px;
    font-weight: 600;
    text-transform: capitalize;
}
.description{
    grid-area:description;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;

    font-family:Inter, "Inter Fallback", sans-serif;
    font-size: 14px;
}

</style>
