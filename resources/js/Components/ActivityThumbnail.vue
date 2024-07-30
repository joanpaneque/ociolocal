<script setup>
import { defineProps } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    activity: {
        type: Object,
        required: true
    }
})
</script>

<template>
    <div class="w-[230px] flex-shrink-0" @click="router.get(route('activities.show_user', activity.id))">
        <div class="h-[180px] rounded-[10px] drop-shadow-md mb-2">
            <img :src="activity.images[0].image.url" alt="Activity thumbnail" class="w-full h-full object-cover rounded-[10px]">
        </div>
        <h3 class="text-[16px] font-[600]">
            {{ activity.activity_name }}
        </h3>
        <h4 class="text-[15px] text-red-500">
            {{ activity.discount }}% de descuento
        </h4>
    </div>
</template>