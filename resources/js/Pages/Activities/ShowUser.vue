<script setup>
import { defineProps, ref } from 'vue';
import GoBackButton from '@/Components/GoBackButton.vue';
import NavigationBar from '@/Components/NavigationBar.vue';

const props = defineProps({
    activity: {
        type: Object,
        required: true
    }
});
</script>

<template>
    <NavigationBar />
    <GoBackButton :route="route('index')" :title="activity.activity_name" />
</template>

<style scoped>

</style>