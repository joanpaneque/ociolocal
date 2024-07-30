<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    text: {
        type: String,
        required: true
    },
    icon: {
        type: String,
        required: false,
        default: ''
    }
})
</script>

<template>
        <div
            class="h-[45px] w-full bg-gradient-to-r from-gradient1 to-gradient2 text-white font-semibold rounded-[9px] flex justify-center items-center gap-[5px]">
            <img v-if="icon" :src="icon" alt="Icon" class="w-[20px] h-[20px] invert" />
            <span class="block">{{ text }}</span>
        </div>
</template>