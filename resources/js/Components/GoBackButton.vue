<script setup>
import { router, usePage } from '@inertiajs/vue3';

const referrer = usePage().props.referrer;

function goBack() {
    // get the referrer from the page, if there is none, redirect to index route
    if (referrer !== window.location.href) {
        router.get(referrer);
    } else {
        router.get(route('index'));
    }
}

</script>

<template>
    <div class="bg-transparent p-4 fixed top-[20px] left-[15px] w-fit" @click="goBack">
        <img src="/assets/icons/left-arrow.svg" alt="Go back" class="w-10 h-10" />
    </div>
</template>