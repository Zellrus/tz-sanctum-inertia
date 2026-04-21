<template>
  <div class="search">
    <div class="search_icon">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon"><path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd"></path></svg>
    </div>
    <input class="search_input" @input="$emit('update:val', $event.target?.value)"  @keyup.enter="search"  v-model="store.filters.search"  type="text" placeholder="Искать">
      <button @click.prevent="search" :class="{ 'visible': store.filters.search }" class="search_btn">Искать</button>
  </div>
</template>
<script setup lang="ts">
import {useActiveFiltersStore} from "@/stores/activeFiltersStore";
import {ref, watch} from "vue";
const store = useActiveFiltersStore();
import { usePage } from '@inertiajs/vue3'
const { url } = usePage()

function search(){
  const search_str = ref<string>(store.filters.name)
    if (url !== '/') return 123

}
let timer: number | null = null
watch(
    () => store.filters.search,
    () => {
        if (timer) clearTimeout(timer)

        timer = setTimeout(() => {
            store.filters.page = 1
            store.getFilteredData()
        }, 400)
    }
)

</script>
<style scoped>
.search{
  border-radius: 20px;
  background: var(--screenshots-bg-color);
  display: flex;
}
.search_icon{
  width: 30px;
  height: 30px;
  display: flex;
  align-self: center;
  justify-content: center;
  padding-left: 10px;
}
.search_input{
  all:unset;
  width: 90%;
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  line-height: 2.25rem;
  text-align: left;
  padding: 0 5px;
}


.search{
  border: 1px solid  var(--screenshots-bg-color);
}

.search:has(.search_input:focus) {
  box-sizing: border-box;
  outline: 2px solid rgb(108, 188, 171);
}
.search_btn{
  all:unset;
  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  margin: auto .625rem;
  display: none;
  background-color: var(--bg-color);
  padding: 5px 10px;
  border-radius: 20px;
  cursor: pointer;
}

.search_btn:hover{
  background-color: var(--button-bg-hover);
}
.search_btn:active{
  background-color: var(--bg-color);
}
.search_btn.visible {
  display: block;
}
</style>
