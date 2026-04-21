<template>
    <div class="filter">
        <div class="filter_header">
            <div style="display:flex;justify-content:center">
                <Button @click="" label="Сбросить фильтр" />
            </div>
        </div>
        <div  class="filter_body">
            <Select
                @click = "getCategories"
                label="Выберите категорию"
                def="---"
                :options="categories?.data"
                @selected = "a => selectedCategory = a.id"
                :errors="errors?.categories"
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

const http = useHttp()
const errors = ref([])
const categories = ref<Category[] | null>(null)
const selectedCategory = ref<Category | null>(null)

function getCategories() {
    if (categories.value !== null ) return categories.value

    window.scrollTo({top: 0, behavior: 'smooth'})
    http.get(`/api/categories`,{
        onSuccess: (response) => {
            categories.value =  response
        }
    })
}

</script>

<style scoped>
.filter{
    /* position: sticky; */
    top: var( --header-height);
    width: 240px;
}
.filter-item-body{
    display:flex;
    max-height: 350px;
    overflow: hidden;
    overflow-y: auto;
    flex-direction: column;
    row-gap:10px;
    margin:10px 0;
    padding: 0 10px;
}

.filter_header{
    padding:10px;
    align-items: center;
    justify-items: center;
}
.filter_body{
    padding:10px;
    display: flex;
    flex-direction: column;
    row-gap:10px;
}
:deep(.accordion-container .header-title:first-letter){
    text-transform: capitalize;
}

@media (max-width: 768px) {
    .filter_body{
        max-height: 70vh;
        overflow-y: auto;
    }
}
</style>
