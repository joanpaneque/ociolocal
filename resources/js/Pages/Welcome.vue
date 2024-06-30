<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import Section from '@/Components/Section.vue';
import ActivityThumbnail from '@/Components/ActivityThumbnail.vue';
import CategoryThumbnail from '@/Components/CategoryThumbnail.vue';



const placeholders = [
    "Plan para el fin de semana",
    "Actividades en familia",
    "Tirarse en paracaídas",
    "Carreras de karts",
    "Ir al cine",
    "Actividades acuáticas en pareja",
    "Actividades en grupo",
    "Rutas turísticas en bicicleta",
    "Actividades de aventura",
    "Actividades de relax",
    "Actividades de adrenalina",
    "Parques acuáticos"
];

const ph = ref('');

const selectedPlaceholder = ref('');


function writePlaceholder() {
    let placeholder = "";
    do {
        placeholder = placeholders[Math.floor(Math.random() * placeholders.length)];
    } while (selectedPlaceholder.value === placeholder);

    let totalWriteTime = 500;
    let length = placeholder.length;

    // if we have to write one character every X ms, how many ms do we have to wait to write the whole string?
    let timePerChar = totalWriteTime / length;

    let i = 0;
    let interval = setInterval(() => {
        ph.value += placeholder[i];
        i++;
        if (i === length) {
            clearInterval(interval);
            selectedPlaceholder.value = placeholder;
            setTimeout(() => {
                removePlaceholder();
            }, 2000);
        }
    }, timePerChar);
}

function removePlaceholder() {
    // remove sequentially the characters from the placeholder
    let totalRemoveTime = 200;
    let length = selectedPlaceholder.value.length;

    // if we have to remove one character every X ms, how many ms do we have to wait to remove the whole string?
    let timePerChar = totalRemoveTime / length;

    let i = 0;
    let interval = setInterval(() => {
        ph.value = ph.value.slice(0, -1);
        i++;
        if (i === length) {
            clearInterval(interval);

        }
    }, timePerChar);
}

writePlaceholder();

setInterval(() => {
    ph.value = '';
    writePlaceholder();
}, 4000);

</script>

<template>

    <Head title="Bienvenido" />
    <header class="bg-[url('/assets/welcome/header.jpg')] h-[220px] bg-cover bg-center relative mb-4">
        <div class="flex items-center justify-center h-full bg-black bg-opacity-70">
            <h1 class="text-[30px] text-white w-[260px] text-center font-[500] leading-9">
                La mejor web de la
                <strong class="bg-gradient-to-r from-pink-500 to-yellow-300 bg-clip-text text-transparent">
                    costa brava
                </strong>
                <img src="/assets/welcome/title_highlighter.svg" alt="Title highlighter" class="w-[165px] mx-auto" />
            </h1>
        </div>
        <div class="w-full h-[40px] bg-white absolute bottom-[-20px] rounded-[50%]"></div>
    </header>
    <main class="flex flex-col pr-4 pl-4">
        <Section title="Descuentos + TOP 🔥" secondary="02:35:13h restantes">
            <div class="flex gap-3 overflow-x-auto w-full pb-2">
                <ActivityThumbnail
                    :activity="{ name: 'SkyDive Empuriabrava', discount: '7% de descuento', thumbnail: '/assets/welcome/skydive.jpg' }" />
                <ActivityThumbnail
                    :activity="{ name: 'Windoor Empuriabrava', discount: '3% de descuento', thumbnail: '/assets/welcome/windoor.avif' }" />
                <ActivityThumbnail
                    :activity="{ name: 'SkyDive Empuriabrava', discount: '7% de descuento', thumbnail: '/assets/welcome/skydive.jpg' }" />
                <ActivityThumbnail
                    :activity="{ name: 'Windoor Empuriabrava', discount: '3% de descuento', thumbnail: '/assets/welcome/windoor.avif' }" />
                <ActivityThumbnail
                    :activity="{ name: 'SkyDive Empuriabrava', discount: '7% de descuento', thumbnail: '/assets/welcome/skydive.jpg' }" />
                <ActivityThumbnail
                    :activity="{ name: 'Windoor Empuriabrava', discount: '3% de descuento', thumbnail: '/assets/welcome/windoor.avif' }" />
                <ActivityThumbnail
                    :activity="{ name: 'SkyDive Empuriabrava', discount: '7% de descuento', thumbnail: '/assets/welcome/skydive.jpg' }" />
                <ActivityThumbnail
                    :activity="{ name: 'Windoor Empuriabrava', discount: '3% de descuento', thumbnail: '/assets/welcome/windoor.avif' }" />
            </div>
        </Section>
        <Section title="¿Qué te apetece?">
            <div class="flex gap-3 overflow-x-auto w-full pb-2">
                <CategoryThumbnail
                    :category="{ name: 'Volar por los aires', emoji: '🪂', thumbnail: '/assets/welcome/skydive_thumb.jpg' }" />
                <CategoryThumbnail
                    :category="{ name: 'Carreras de karts', emoji: '🏎️', thumbnail: '/assets/welcome/karting_thumb.jpg' }" />
                <CategoryThumbnail
                    :category="{ name: 'Parques de diversión', emoji: '🎢', thumbnail: '/assets/welcome/aquabrava_thumb.jpg' }" />
                <CategoryThumbnail
                    :category="{ name: 'Cine y teatro', emoji: '🎬', thumbnail: '/assets/welcome/cine_thumb.jpg' }" />
                <CategoryThumbnail
                    :category="{ name: 'Acuático', emoji: '🌊', thumbnail: '/assets/welcome/jet_ski_thumb.jpg' }" />
            </div>

        </Section>
        <Section title="Encuentra un plan para ti">
            <div class="bg-gradient-to-r from-pink-500 to-yellow-300 rounded-[10px] p-[1px] relative">
                <img src="/assets/icons/search.svg" alt="Search icon"
                    class="absolute w-[20px] top-[50%] left-3 transform -translate-y-1/2 pointer-events-none" />
                <img src="/assets/welcome/AI.svg" alt="AI"
                    class="absolute bottom-[-40px] left-[80px] pointer-events-none" />

                <input type="text"
                    class="pl-[40px] w-full border border-gray-300 border-none bg-white rounded-[10px] p-2"
                    :placeholder="ph" />
            </div>
        </Section>
        <Section title="Opiniones">

        </Section>
    </main>
</template>
