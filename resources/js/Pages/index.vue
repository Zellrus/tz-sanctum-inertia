<template>
    <Head title="Главная страница"/>
    <AppLayout>
    <main>
        <Filter/>
        <div class="content-container">
            <div class="content-body">
                <ProductItem v-for="product in products.data" :item="product"/>
<!-- v-if="!store.loading"-->
<!--                <Skeleton v-else v-for="i in 10" width="100%" height="100px" ></Skeleton>-->
            </div>
            <p v-if="products?.data.length <= 0 && !store.loading" style="place-self: center">Нет подходящих продуктов. Попробуйте поменять фильтры</p>
            <PaginationComponent @change_page="changePage" :content="products.meta" style="place-self: center"/>
        </div>
    </main>
    </AppLayout>
</template>

<script setup lang="ts">
import ProductItem from "../Components/ProductItem.vue";
import {Product} from "@/Types/product";
import {Pagination} from "@/Types/api";
import AppLayout from "../Layouts/AppLayout.vue";
import PaginationComponent from "../Components/Pagination.vue";
import {ref, watch} from "vue";
import Filter from "../Components/Filter.vue";
import Skeleton from "@/Components/Skeleton.vue";
import {useActiveFiltersStore} from "@/stores/activeFiltersStore";
import {Head} from "@inertiajs/vue3";
const props = defineProps<{
    data: Pagination<Product>
}>()
const store = useActiveFiltersStore()
const products = ref(props.data)

function changePage(page = 1) {
    store.filters.page = page
    store.getFilteredData()

}
watch(() => store.filteredData, (newData) => {
    products.value = newData
})
</script>

<style scoped>

.content-container{
    display: flex;
    flex-direction: column;
    gap:10px;
}
.content-body{
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
    gap:10px;
}

</style>
