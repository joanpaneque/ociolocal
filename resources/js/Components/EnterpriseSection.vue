<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    href: {
        type: String,
        required: true
    },
    title: {
        type: String,
        required: true
    },
    icon: {
        type: String,
        required: false
    }
})
</script>

<template>
    <div class="bg-gradient-to-r from-[#EC48C1] to-[#FED860] w-full h-[140px] rounded-[14px] p-[2px] flex items-center justify-center">
        <div class="bg-white w-full h-full rounded-[13px] flex items-center justify-center flex-col px-[20px] gap-2">
            <img :src="icon" alt="Icon" class="w-[60px] h-[60px]">
            <span class="text-[15px] font-[600] text-center leading-4">{{ title }}</span>
        </div>
    </div>
</template>