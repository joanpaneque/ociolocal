<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    text: {
        type: String,
        required: true
    }
})
</script>

<template>
        <button
            class="h-[45px] w-full bg-gradient-to-r from-gradient1 to-gradient2 text-white font-semibold rounded-[9px]">
            {{ text }}
        </button>
</template>