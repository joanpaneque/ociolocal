<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    activity: {
        type: Object,
        required: true
    }
})
</script>

<template>
    <div class="w-[230px] flex-shrink-0">
        <div class="h-[180px] rounded-[10px] drop-shadow-md mb-2">
            <img :src="activity.thumbnail" alt="Activity thumbnail" class="w-full h-full object-cover rounded-[10px]">
        </div>
        <h3 class="text-[20px] font-[600]">
            {{ activity.name }}
        </h3>
        <h4 class="text-[18px] text-red-500">
            {{ activity.discount }}
        </h4>
    </div>
</template>