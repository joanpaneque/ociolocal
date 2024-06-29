<script setup>
import { Head } from '@inertiajs/vue3';


function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
    <Head title="Bienvenido" />
    <header class="bg-[url('/assets/welcome/header.jpg')] h-[177px] bg-cover bg-center relative mb-4">
        <div class="flex items-center justify-center h-full bg-black bg-opacity-70">
            <h1 class="text-2xl text-white w-[230px] text-center font-[500]">
                La mejor web de la
                <strong class="bg-gradient-to-r from-pink-500 to-yellow-300 bg-clip-text text-transparent">
                    costa brava
                </strong>
                <img src="/assets/welcome/title_highlighter.svg" alt="Title highlighter" class="w-[135px] mx-auto" />
            </h1>
        </div>
        <div class="w-full h-[40px] bg-white absolute bottom-[-20px] rounded-[50%]"></div>
    </header>
    <main class="flex flex-col pr-4 pl-4">
        <section>
            <div class="grid items-center justify-between mb-4 grid-cols-[auto,1fr]">
                <h2 class="text-[20px] font-[700]">
                    Descuentos + TOP 🔥
                </h2>
                <div class="text-[14px] text-gray-500 leading-[1] text-right font-bold">
                    02:35:13h restantes
                </div>
            </div>
        </section>
    </main>
</template>
