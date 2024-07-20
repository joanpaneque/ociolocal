<script setup>
import { ref, defineProps } from 'vue';
import { router, useForm } from '@inertiajs/vue3';
import GoBackButton from '@/Components/GoBackButton.vue';
import OcioInput from '@/Components/OcioInput.vue';
import OcioSubmit from '@/Components/OcioSubmit.vue';
import OcioSwitch from '@/Components/OcioSwitch.vue';
import OcioDateRange from '@/Components/OcioDateRange.vue';
import OcioWeekHours from '@/Components/OcioWeekHours.vue';
import 'cally';

const props = defineProps({
    company: {
        type: Object,
        required: true
    }
});

const form = useForm({
    'activity_name': null,
    'season': false,
    'date_start': null,
    'date_end': null,
    'date_event': null,
    'hours_monday': [],
    'hours_tuesday': [],
    'hours_wednesday': [],
    'hours_thursday': [],
    'hours_friday': [],
    'hours_saturday': [],
    'hours_sunday': [],
});



</script>

<template>
    <GoBackButton :route="route('users.companies.activities.index', [$page.props.auth.user.id, company.id])"
        title="Nueva actividad" />
    <form class="px-[40px] w-full flex flex-col gap-4"
        @submit.prevent="form.post(route('users.companies.activities.store', [$page.props.auth.user.id, company.id]))">
        <div class="flex flex-col">
            <h2 class="font-bold">Información general</h2>
            <div>
                <OcioInput placeholder="Nombre de la actividad" icon="/assets/icons/island_tropical.svg"
                    v-model="form.activity_name" autofocus />
            </div>
            <div>
                <h2 class="mt-2">Tipo de actividad</h2>
                <OcioSwitch first="Evento" second="Temporada" v-model="form.season" />
            </div>
            <div v-if="form.season">
                <h2 class="mt-2 mb-1">Duración de la actividad</h2>
                <OcioDateRange v-model:date_start="form.date_start" v-model:date_end="form.date_end" />
                <h2 class="mt-2 mb-1">Horario semanal</h2>
                <OcioWeekHours
                    v-model:hours_monday="form.hours_monday"
                    v-model:hours_tuesday="form.hours_tuesday"
                    v-model:hours_wednesday="form.hours_wednesday"
                    v-model:hours_thursday="form.hours_thursday"
                    v-model:hours_friday="form.hours_friday"
                    v-model:hours_saturday="form.hours_saturday"
                    v-model:hours_sunday="form.hours_sunday"
                />
            </div>
            <div v-else>
            </div>

            <div>
                <h2 class="font-bold mt-4">Gestión de ventas</h2>
                <OcioInput placeholder="Personas máximas simultáneas" icon="/assets/icons/island_tropical.svg" />
            </div>
        </div>
        <div class="flex flex-col gap-1">

        </div>
        <div class="flex flex-col gap-1">
            <h2></h2>
        </div>
        <OcioSubmit class="mb-8">Crear actividad</OcioSubmit>
    </form>
</template>
