<script setup>
import { Head } from '@inertiajs/vue3';
import Section from '@/Components/Section.vue';
import ActivityThumbnail from '@/Components/ActivityThumbnail.vue';


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
        <Section title="Descuentos + TOP 🔥" secondary="02:35:13h restantes">
            <div class="flex gap-3 overflow-x-auto w-full">
                <ActivityThumbnail :activity="{ name: 'SkyDive Empuriabrava', discount: '7% de descuento', thumbnail: '/assets/welcome/skydive.jpg' }" />
                <ActivityThumbnail :activity="{ name: 'Windoor Empuriabrava', discount: '3% de descuento', thumbnail: '/assets/welcome/windoor.avif' }" />
                <ActivityThumbnail :activity="{ name: 'SkyDive Empuriabrava', discount: '7% de descuento', thumbnail: '/assets/welcome/skydive.jpg' }" />
                <ActivityThumbnail :activity="{ name: 'Windoor Empuriabrava', discount: '3% de descuento', thumbnail: '/assets/welcome/windoor.avif' }" />
                <ActivityThumbnail :activity="{ name: 'SkyDive Empuriabrava', discount: '7% de descuento', thumbnail: '/assets/welcome/skydive.jpg' }" />
                <ActivityThumbnail :activity="{ name: 'Windoor Empuriabrava', discount: '3% de descuento', thumbnail: '/assets/welcome/windoor.avif' }" />
                <ActivityThumbnail :activity="{ name: 'SkyDive Empuriabrava', discount: '7% de descuento', thumbnail: '/assets/welcome/skydive.jpg' }" />
                <ActivityThumbnail :activity="{ name: 'Windoor Empuriabrava', discount: '3% de descuento', thumbnail: '/assets/welcome/windoor.avif' }" />
                
            </div>
        </Section>

        <Section title="¿Qué te apetece?">

        </Section>
        <Section title="Encuentra un plan para ti">

        </Section>
        <Section title="Opiniones">

        </Section>
    </main>
</template>
