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

    <div class="w-[260px] flex-shrink-0 drop-shadow-md">
        <div class="h-[180px] rounded-t-[10px] rounded-b-none overflow-hidden">
            <img :src="activity.images[0].image.url" alt="Activity thumbnail" class="w-full h-full object-cover">
        </div>
        <div class="h-fit rounded-b-[10px] rounded-t-none px-4 py-2 bg-white border border-gray-200">
            <h3 class="text-[16px] font-[600]">
                {{ activity.activity_name }}
            </h3>
            <div class="flex gap-4 mt-2">
                <div class="text-[15px] text-gray-500 flex items-center gap-1">
                    <img src="/assets/icons/eye.svg" alt="Visitors" class="w-[20px] h-[20px] opacity-40">
                    <div>{{ activity.views ?? '999.999' }}</div>
                </div>
                <div class="text-[15px] text-gray-500 flex items-center gap-1">
                    <img src="/assets/icons/interactive.svg" alt="Clicks" class="w-[20px] h-[20px] opacity-40">
                    <div>{{ activity.clicks ?? '99.999' }}</div>
                </div>
                <div class="text-[15px] text-gray-500 flex items-center gap-1">
                    <img src="/assets/icons/sale.svg" alt="Sales" class="w-[20px] h-[20px] opacity-40">
                    <div>{{ activity.sales ?? '9999' }}</div>
                </div>
            </div>
        </div>

        <h4 class="text-[15px] text-red-500">
            {{ activity.discount }}
        </h4>
    </div>
</template>