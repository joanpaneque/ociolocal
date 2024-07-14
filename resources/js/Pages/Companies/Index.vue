<script setup>
import { router } from '@inertiajs/vue3';
import GoBackButton from '@/Components/GoBackButton.vue';

</script>

<template>
    <GoBackButton :route="route('users.show', $page.props.auth.user.id)" title="Mis empresas" />
    <div class="px-[40px] w-full">
        <button
            @click="router.get(route('users.companies.create', $page.props.auth.user.id))"
            class="h-[45px] w-full bg-gradient-to-r from-gradient1 to-gradient2 text-white font-semibold rounded-[9px]">
            Crear empresa
        </button>
    </div>
</template>