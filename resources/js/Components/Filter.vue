<template>
    <div class="filter">
        <div class="filter_header">
            <div style="display:flex;justify-content:center">
                <Button @click="" label="Сбросить фильтр" />
            </div>
        </div>
        <div  class="filter_body">
            <Accordion  header-title="Категории">
                <template #content>
                    <div class="filter-item-body">
<!--                        <Radio-->
<!--                            v-for="item in filters.channels"-->
<!--                            :key="item.slug"-->
<!--                            :title="item.name"-->
<!--                            :id="item.slug"-->
<!--                            group="channel"-->
<!--                            :modelValue="store.filters.channel"-->
<!--                            @update:modelValue="updateFilter('channel', $event)"-->
<!--                        />-->
                    </div>
                </template>
            </Accordion>
        </div>
    </div>
</template>

<script setup>

import Button from "./Input/Button.vue";
import Accordion from "./Accordion.vue";
import Radio from "./Input/Radio.vue";

// const store = useActivePackagesFiltersStore()



// const filters = await packagesFiltersStore.getData()

// function updateFilter(field, value) {
//     store.filters[field] = value
//     refresh()
// }
// function updateArrayFilter(field, { id, checked }) {
//     const target = store.filters[field]
//
//     const index = target.indexOf(id)
//
//     if (checked && index === -1) target.push(id)
//     if (!checked && index !== -1) target.splice(index, 1)
//
//     refresh()
// }
// function refresh() {
//     store.filters.page = 1
//     store.getFilteredData()
// }


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
