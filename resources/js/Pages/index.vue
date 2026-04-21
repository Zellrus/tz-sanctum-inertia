<template>
    <AppLayout>
    <main>
        <Filter/>
        <div class="content-container">
            <div class="content-body">
                <ProductItem v-if="!loading" v-for="product in products.data" :item="product"/>
                <Skeleton v-else v-for="i in 10" width="100%" height="100px" ></Skeleton>
            </div>

            <PaginationComponent @change_page="loadProducts" :content="products.meta" style="place-self: center"/>
        </div>
    </main>
    </AppLayout>
</template>

<script setup lang="ts">
import ProductItem from "../Components/ProductItem.vue";
import {Product} from "../Types/product";
import {Pagination} from "../Types/api";
import AppLayout from "../Layouts/AppLayout.vue";
import PaginationComponent from "../Components/Pagination.vue";
import { useHttp } from '@inertiajs/vue3'
import {ref} from "vue";
import Filter from "../Components/Filter.vue";
import Skeleton from "@/Components/Skeleton.vue";
const props = defineProps<{
    data: Pagination<Product>
}>()
const products = ref(props.data)
const http = useHttp()
const loading  = ref<boolean>(false)
function loadProducts(page = 1) {
    loading.value = true
    window.scrollTo({top: 0, behavior: 'smooth'})
        http.get(`/api/products?page=${page}`,{
            onSuccess: (response) => {
                products.value =  response
            },
            onFinish:()=>{
                loading.value = false;
            }
    })
}

</script>

<style scoped>
main{
    display: grid;
    grid-template-columns: auto 1fr;
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
