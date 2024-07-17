<script setup>
import GoBackButton from '@/Components/GoBackButton.vue';
import { defineProps } from 'vue';

const props = defineProps({
    company: {
        type: Object,
        required: true
    }
})
</script>

<template>
    <GoBackButton :route="route('users.companies.index', $page.props.auth.user.id)" :title="company.company_name" />
</template>