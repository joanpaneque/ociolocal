<script setup>
import GoBackButton from '@/Components/GoBackButton.vue';
import EnterpriseSection from '@/Components/EnterpriseSection.vue';
import { defineProps } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    company: {
        type: Object,
        required: true
    }
})
</script>

<template>
    <GoBackButton :route="route('users.companies.index', $page.props.auth.user.id)" :title="company.company_name" />
    <div class="px-[40px]">
        <div class="grid grid-cols-2 gap-4">
            <EnterpriseSection icon="/assets/icons/scan_qr.svg" title="Escanear entradas" />
            <EnterpriseSection icon="/assets/icons/island_tropical.svg" title="Mis actividades" @click="router.get(route('users.companies.activities.index', [$page.props.auth.user.id, company.id]))" />

        </div>

    </div>
</template>