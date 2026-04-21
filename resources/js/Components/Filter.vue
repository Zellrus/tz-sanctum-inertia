<template>
    <div class="filter">
        <div class="filter_body">
            <Button @click="resetFilter" label="Сбросить фильтры" />
            <Search/>
            <Select
                @click = "getCategories"
                def="Выберите категорию"
                :options="categories?.data"
                @selected = "categorySelect"
                :selected = "store.filters.category_id"
                :errors="errors?.categories"
                style="width: 300px"
            />
        </div>
    </div>
</template>

<script setup lang="ts">
import Button from "./Input/Button.vue";
import {useHttp} from "@inertiajs/vue3";
import {Category} from "@/Types/category";
import Select from '@/Components/Fields/Select.vue'
import {ref} from "vue";
import {useActiveFiltersStore} from "@/stores/activeFiltersStore";
import Search from "@/Components/Fields/Search.vue";

const http = useHttp()
const errors = ref([])
const categories = ref<Category[] | null>(null)
const store = useActiveFiltersStore()

function getCategories() {
    if (categories.value !== null ) return categories.value

    window.scrollTo({top: 0, behavior: 'smooth'})
    http.get(`/api/categories`,{
        onSuccess: (response) => {
            categories.value =  response
        }
    })
}

function resetFilter(){
    store.resetFilter()
}
function categorySelect(a: Category){
    store.filters.category_id = a.id
    store.getFilteredData()
}

</script>

<style scoped>
.filter{
    /* position: sticky; */
    top: var( --header-height);
    /*width: 240px;*/
}
.filter_body{
    padding:10px;
    gap:10px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.search{
    width: 40%;
    justify-self: center;
    height: 40px;
}
@media (max-width: 768px) {
    .filter_body{
        max-height: 70vh;
        overflow-y: auto;
    }
}
</style>
