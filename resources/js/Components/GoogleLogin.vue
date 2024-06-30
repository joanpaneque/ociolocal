<script setup>
import { router } from '@inertiajs/vue3';

</script>

<template>
    <a :href="route('google.redirect')"
        class="text-[15px] h-[40px] w-full rounded-[10px] flex items-center justify-start relative border border-gray-500 px-3 py-6 mt-4">
        <img src="/assets/icons/google_logo.png" alt="Google logo" class="h-[30px] w-[30px] mr-2">
        <div class="text-gray-500">Iniciar sesión con Google</div>
    </a>
</template>