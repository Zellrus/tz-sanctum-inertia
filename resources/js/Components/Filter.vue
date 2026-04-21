<template>
    <div class="filter">
        <div class="filter_body">
            <Button @click="resetFilter" label="Сбросить фильтры" />
            <Search/>
            <Select
                @click = "filterStore.getCategories"
                def="Выберите категорию"
                :options="filterStore.categories?.data"
                @selected = "categorySelect"
                :selected = "store.filters.category_id"
                :errors="errors?.categories"
                style="width: 300px"
            />
        </div>
    </div>
</template>

<script setup lang="ts">
import Button from "./Inputs/Button.vue";

import {Category} from "@/Types/category";
import Select from '@/Components/Fields/Select.vue'
import {ref} from "vue";
import {useActiveFiltersStore} from "@/stores/activeFiltersStore";
import Search from "@/Components/Fields/Search.vue";
import {useFiltersStore} from "@/stores/filtersStore";

const errors = ref([])
const store = useActiveFiltersStore()
const filterStore = useFiltersStore()

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
