<template>
<div>
    <p style="place-self: center; display: flex">Вы точно хотите удалить продукт: {{product.name}} ?</p>
    <div class="btn-group">
        <Button @click="destroy" style_type="danger" label="Да, удалить"/>
        <Button @click="emit('close')" label="Отмена"/>
    </div>
</div>
</template>
<script setup>
import Button from "@/Components/Inputs/Button.vue";
import api from "@/api/axios.ts";
import {useActiveFiltersStore} from "@/stores/activeFiltersStore";
const props =  defineProps({
    product: Object
})
const emit = defineEmits(['close']);
const store = useActiveFiltersStore()
function destroy(){
    api.delete(`/products/${props.product.id}`).then(res => {
        store.getFilteredData()
        emit('close');

    })
}
</script>
<style scoped>
.btn-group{
    display: flex;
    gap: 5px;
    place-self: center;
    margin-top:  10px;
}
</style>
