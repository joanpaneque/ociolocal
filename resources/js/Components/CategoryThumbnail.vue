<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    category: {
        type: Object,
        required: true
    }
})
</script>

<template>
    <div class="w-[75px] flex-shrink-0">
        <div class="h-[75px] rounded drop-shadow-md mb-1">
            <img :src="category.thumbnail" alt="Activity thumbnail"
                class="w-full h-full object-cover rounded-[10px]">
        </div>
        <h3 class="text-[13px] font-[600] text-center">
            {{ category.name }}<br>{{ category.emoji }}
        </h3>
    </div>
</template>