<script setup>
import { usePage, router } from '@inertiajs/vue3';
const user = usePage().props.auth.user;
const currentRoute = route().current();

</script>

<template>
    <nav class="fixed bottom-0 w-full bg-white shadow-inner pb-5">
        <div v-if="user" class="flex justify-around items-center h-[60px] pr-4 pl-4 gap-5" >
            <div class="flex gap-[2px] items-center flex-col">
                <img src="/assets/icons/qr.svg" alt="Booking icon" class="w-[20px]" />
                <h2 class="text-[12px] font-bold">Reservas</h2>
            </div>
            <div class="flex gap-[2px] items-center flex-col p-[7px] rounded-xl" :style="{ background: currentRoute === 'index' ? '#00000010' : 'transparent' }">
                <img src="/assets/icons/fire.svg" alt="Booking icon" class="w-[20px]" />
                <h2 class="text-[12px] font-bold">Ofertas</h2>
            </div>
            <div class="flex gap-[2px] items-center flex-col">
                <img src="/assets/icons/search.svg" alt="Booking icon" class="w-[20px]" />
                <h2 class="text-[12px] font-bold">Buscar</h2>
            </div>
            <div
                @click="router.get(route('user.show', user.id))"   
                class="w-[40px] h-[40px] rounded-[50%] border-spacing-8 border-2 border-gray-300 overflow-hidden">
                <img :src="user.avatar"
                alt="User avatar" class="w-[100%] h-[100%] rounded-[50%] object-cover" />
            </div>
        </div>
        <div v-else class="flex justify-around items-center h-[60px] pr-4 pl-4 gap-5" >
            <div class="flex gap-[2px] items-center flex-col p-[7px] rounded-xl" :style="{ background: currentRoute === 'index' ? '#00000010' : 'transparent' }">
                <img src="/assets/icons/fire.svg" alt="Booking icon" class="w-[20px]" />
                <h2 class="text-[12px] font-bold">Ofertas</h2>
            </div>
            <div class="flex gap-[2px] items-center flex-col">
                <img src="/assets/icons/search.svg" alt="Booking icon" class="w-[20px]" />
                <h2 class="text-[12px] font-bold">Buscar</h2>
            </div>
            <div class="flex gap-[15px] items-center">
                <button
                @click="router.get(route('login'))"
                class="bg-gradient-to-r from-pink-500 to-orange-400 text-white rounded-[10px] p-2">Acceder</button>
                <button class="bg-gradient-to-r from-orange-400 to-fuchsia-400 text-white rounded-[10px] p-2">Registrarme</button>
            </div>
        </div>
    </nav>

</template>