<script setup>
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import OcioInput from '@/Components/OcioInput.vue';
import OcioSubmit from '@/Components/OcioSubmit.vue';
import GoogleLogin from '@/Components/GoogleLogin.vue';


const form = useForm({
    email: '',
    password: '',
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>

    <Head title="Iniciar sesión" />
    <div class="px-[40px] mx-auto">
        <div class="mb-5">
            <h1 class="text-[24px] font-bold mb-[-3px]">Inicia sesión</h1>
            <p class="text-[12px] font-light">Introduce tus datos para continuar.</p>
        </div>
        <form @submit.prevent="submit" class="flex flex-col gap-3">
            <OcioInput name="email" v-model="form.email" placeholder="Correo electrónico" icon="/assets/icons/at.svg"
                autofocus />
            <OcioInput name="password" v-model="form.password" placeholder="Contraseña" icon="/assets/icons/key.svg"
                type="password" />
            <OcioSubmit>Iniciar sesión</OcioSubmit>
        </form>
        <div class="flex justify-center align-center mt-4">
            <Link :href="route('register')" class="text-[13px] text-gradient2 underline">He olvidado mi contraseña</Link>
        </div>
        <GoogleLogin />
    </div>
</template>
