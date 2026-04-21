<template>
    <Head title="Создание продукта"/>
    <AppLayout>
    <main>
        <form @submit.prevent="submit">
            <Input
                label="Название"
                v-model="form.name"
                type="text"
                :input-attrs="{
                    maxlength:30,
                    required: true,
                }"
                :errors="errors?.name"
            />
            <Textarea
                label="Описание"
                v-model="form.description"
                :textarea-attrs="{
              maxlength:220,
            }"
                :errors="errors?.description"
            />
            <Select
                @click = "store.getCategories"
                def="Выберите категорию"
                :options="store.categories?.data"
                @selected = "(a)=> form.category_id = a.id"
                :errors="errors?.category_id"
            />
            <Input
                label="Цена"
                v-model="form.price"
                type="text"
                :input-attrs="{
                    min:1,
                    required: true,
                    pattern: '^\\d{1,8}(\\.\\d{1,2})?$',
                    title:`Введите число до 10 цифр, с максимум 2 цифрами после точки`
            }"
                :errors="errors?.price"
            />
            <Button style="align-self: center">Создать</Button>

        </form>
    </main>
    </AppLayout>
</template>
<script setup>

import Input from "@/Components/Fields/Input.vue";
import Textarea from "@/Components/Fields/Textarea.vue";
import {reactive, ref} from "vue";
import Button from "@/Components/Inputs/Button.vue";

import Select from "@/Components/Fields/Select.vue";
import {useFiltersStore} from "@/stores/filtersStore.ts";
import {Head} from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import api from "@/api/axios.ts";
import { router } from '@inertiajs/vue3'
const errors = ref(null)

const form = reactive({
    name: '',
    description:'',
    category_id:null,
    price: null
})
const emit = defineEmits(['close']);

const store = useFiltersStore()

async function submit() {

    api.post('products', form)
        .then(res=>{
            if (res.status === 201) router.visit('/admin/products')
        })
        .catch(error =>{
            errors.value =  error.response.data.errors
        })
}

</script>
<style scoped>
form{
    display: flex;
    flex-direction: column;
    gap:10px;
}
</style>
