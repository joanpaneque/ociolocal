<script setup>
import { defineProps } from 'vue';
import { router } from '@inertiajs/vue3';


const props = defineProps({
    route: {
        type: Object,
        required: true
    },
    title: {
        type: String,
        required: false
    },
    occupySpace: {
        type: Boolean,
        required: false,
        default: true
    }
})

function goBack() {
    router.get(props.route);
}

</script>

<template>
    <div class="bg-white p-4 fixed top-[0px] left-[15px] w-full flex items-center gap-5 z-40" @click="goBack">
        <img src="/assets/icons/left-arrow.svg" alt="Go back" class="w-10 h-10" />
        <h1 class="text-[28px] font-[600]" v-if="title">
            {{ title }}
        </h1>
    </div>
    <div class="h-[100px]" v-if="occupySpace">
    </div>
</template>