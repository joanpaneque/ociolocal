<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';



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
    <form @submit.prevent="submit">
        <h1>¡Hola!</h1>
        <h2>Nos alegra verte de nuevo</h2>
    </form>
</template>
