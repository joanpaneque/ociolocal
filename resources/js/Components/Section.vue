<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    title: {
        type: String,
        required: true
    },
    secondary: {
        type: String,
        required: false
    }
})
</script>

<template>
    <section>
        <div class="grid items-center justify-between mb-4 grid-cols-[auto,1fr]">
            <h2 class="text-[20px] font-[700]">
                {{ title }}
            </h2>
            <div class="text-[12px] leading-[1] text-right font-bold">
                {{ secondary }}
            </div>
        </div>
        <slot/>
    </section>
</template>