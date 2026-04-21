<template>
    <AppLayout>
    <main>
        <Filter/>
        <div class="content-container">
            <div class="content-body">
                <ProductItem  v-for="product in products.data" :item="product"/>
<!-- v-if="!store.loading"-->
<!--                <Skeleton v-else v-for="i in 10" width="100%" height="100px" ></Skeleton>-->
            </div>

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
import {ref} from "vue";
import Filter from "../Components/Filter.vue";
import Skeleton from "@/Components/Skeleton.vue";
import {useActiveFiltersStore} from "@/stores/activeFiltersStore";
const props = defineProps<{
    data: Pagination<Product>
}>()
const store = useActiveFiltersStore()
const products = ref(props.data)

function changePage(page = 1) {
    store.filters.page = page
    store.getFilteredData().then(data => {
        products.value = data
    })
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
/*.content-body{*/
/*    display: flex;*/
/*    flex-direction: column;*/

/*}*/
</style>
