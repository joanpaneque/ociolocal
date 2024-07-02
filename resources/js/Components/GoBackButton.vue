<script setup>
import { defineProps } from 'vue';
import { router } from '@inertiajs/vue3';


const props = defineProps({
    route: {
        type: String,
        required: false,
        default: 'index'
    }
})

function goBack() {
    router.get(route(props.route));
}

</script>

<template>
    <div class="bg-transparent p-4 fixed top-[20px] left-[15px] w-fit" @click="goBack">
        <img src="/assets/icons/left-arrow.svg" alt="Go back" class="w-10 h-10" />
    </div>
</template>