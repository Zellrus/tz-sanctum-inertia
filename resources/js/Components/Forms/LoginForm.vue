<template>
<form @submit.prevent="submit">
    <Input
        label="Почта"
        v-model="loginForm.email"
        type="email"
        :input-attrs="{
         maxlength:30,
         required: true,
       }"
        :errors="errors?.email"
    />
    <Input
        label="Пароль"
        v-model="loginForm.password"
        type="password"
        :input-attrs="{
         maxlength:30,
         required: true,
       }"
        :errors="errors?.password"
    />
    <Button style="align-self: center">Войти</Button>
    <div style="font-size: 12px; place-self: center">
        <span>Пользователя можно создать командой <span style="font-family: monospace">php artisan db:seed --class=UserSeeder</span></span>
       <div style="place-self: center">почта: admin@test.com, пароль: password</div>
    </div>

</form>
</template>
<script setup>

import Input from "@/Components/Fields/Input.vue";
import {reactive, ref} from "vue";
import Button from "@/Components/Inputs/Button.vue";

import {useAuthStore} from "@/stores/useAuthStore.ts";
const errors = ref(null)
const auth = useAuthStore()
const loginForm = reactive({
    email: '',
    password:'',
})
const emit = defineEmits(['close']);
async function submit() {

    const result = await auth.login({
        email: loginForm.email,
        password: loginForm.password
    })

    if (!result.success) {
        errors.value = result.errors
        return
    }
    emit('close')
}

</script>
<style scoped>
form{
    display: flex;
    flex-direction: column;
    gap:10px;
}
</style>
