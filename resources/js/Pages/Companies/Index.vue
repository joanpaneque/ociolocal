<script setup>
import { defineProps } from 'vue';
import { router } from '@inertiajs/vue3';
import GoBackButton from '@/Components/GoBackButton.vue';
import OcioButton from '@/Components/OcioButton.vue';

const props = defineProps({
    companies: {
        type: Object,
        required: true
    }
})

</script>

<template>
    <GoBackButton :route="route('users.show', $page.props.auth.user.id)" title="Mis empresas" />
    <div class="px-[40px] w-full">
        <OcioButton text="Crear empresa" @click="router.get(route('users.companies.create', $page.props.auth.user.id))" />
        <div class="mt-3 flex flex-col gap-3">
            <div
                v-for="company in companies"
                :key="company.id"
                @click="router.get(route('users.companies.show', [$page.props.auth.user.id, company.id]))"
                class="w-full h-[150px] shadow-md rounded-[9px] overflow-hidden border border-gray-400 flex items-center justify-center">
                <img :src="company.image" :alt="company.company_name" class="w-full object-cover"/>
            </div>
        </div>
        <!-- <img v-for="company in companies" :key="company.id" :src="company.image" :alt="company.company_name" class="w-[100px] h-[100px]"/> -->
    </div>
</template>