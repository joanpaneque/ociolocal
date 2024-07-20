<script setup>
import { ref, defineProps } from 'vue';
import { router, useForm } from '@inertiajs/vue3';
import GoBackButton from '@/Components/GoBackButton.vue';
import OcioInput from '@/Components/OcioInput.vue';
import OcioImage from '@/Components/OcioImage.vue';
import OcioSubmit from '@/Components/OcioSubmit.vue';
import OcioSwitch from '@/Components/OcioSwitch.vue';
import OcioDateRange from '@/Components/OcioDateRange.vue';
import 'cally';

const props = defineProps({
    company: {
        type: Object,
        required: true
    }
});

const form = useForm({
    'activity_name': null,
    'season': true,
    'date_start': null,
    'date_end': null,
    'date_event': null
});



</script>

<template>
    <GoBackButton :route="route('users.companies.activities.index', [$page.props.auth.user.id, company.id])" title="Nueva actividad" />
    <form class="px-[40px] w-full flex flex-col gap-4" @submit.prevent="form.post(route('users.companies.activities.store', [$page.props.auth.user.id, company.id]))">
        <div class="flex flex-col gap-1">
            <h2 class="font-bold">Información general</h2>
            <OcioInput placeholder="Nombre de la actividad" icon="/assets/icons/island_tropical.svg" v-model="form.activity_name" autofocus/>
            <span v-if="form.errors.activiy" class="text-red-600">{{ form.errors.activiy }}</span>
            <h2 class="mt-1">Tipo de actividad</h2>
            <OcioSwitch first="Evento" second="Temporada" v-model="form.season"/>
        </div>
        <div class="flex flex-col gap-1" v-if="form.season">
            <h2>Duración de la temporada</h2>
            <OcioDateRange v-model:date_start="form.date_start" v-model:date_end="form.date_end"/>

        </div>
        <div class="flex flex-col gap-1" v-else>
            <h2></h2>
        </div>
        <OcioSubmit class="mb-8">Crear actividad</OcioSubmit>
    </form>
</template>
