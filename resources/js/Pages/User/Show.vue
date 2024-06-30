<script setup>
import { defineProps } from 'vue';
import NavigationBar from '@/Components/NavigationBar.vue';

const props = defineProps({
    user: {
        type: Object,
        required: true
    }
})
</script>

<template>
    <div class="flex flex-col items-center">
        <img :src="user.avatar" alt="User avatar" class="w-[100px] h-[100px] rounded-full mb-4 mt-4 border-2 border-gray-300">
    </div>
    <NavigationBar/>
</template>
