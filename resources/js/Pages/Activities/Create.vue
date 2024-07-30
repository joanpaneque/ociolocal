<script setup>
import { ref, defineProps } from 'vue';
import { router, useForm } from '@inertiajs/vue3';
import GoBackButton from '@/Components/GoBackButton.vue';
import OcioInput from '@/Components/OcioInput.vue';
import OcioSubmit from '@/Components/OcioSubmit.vue';
import OcioSwitch from '@/Components/OcioSwitch.vue';
import OcioDateRange from '@/Components/OcioDateRange.vue';
import OcioWeekHours from '@/Components/OcioWeekHours.vue';
import OcioButton from '@/Components/OcioButton.vue';
import OcioModal from '@/Components/OcioModal.vue';
import OcioContribution from '@/Components/OcioContribution.vue';
import OcioImages from '@/Components/OcioImages.vue';
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
    'weekly_schedule': {
        'monday': [],
        'tuesday': [],
        'wednesday': [],
        'thursday': [],
        'friday': [],
        'saturday': [],
        'sunday': []
    },
    'max_concurrent_people': null,
    'ticket_types': [{
        'name': "Entrada general",
        'price': null
    }],
    'contribution': '10',
    'images': []
});

const isOpenContributionModal = ref(false);



function getCheapestTicket() {
    if (form.ticket_types.length === 0) return null;
    if (form.ticket_types.some(ticket => !ticket.price)) return null;
    return form.ticket_types.reduce((prev, curr) => prev.price < curr.price ? prev : curr);
}

function createActivity() {
    form.post(route('users.companies.activities.store', [$page.props.auth.user.id, company.id]));
}



</script>

<template>
    <GoBackButton :route="route('users.companies.activities.index', [$page.props.auth.user.id, company.id])"
        title="Nueva actividad" />
    <form class="px-[10%] w-full flex flex-col gap-4"
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
                <OcioWeekHours v-model="form.weekly_schedule" />
            </div>
            <div v-else>
            </div>

            <div>
                <h2 class="font-bold mt-4">Gestión de ventas</h2>
                <OcioInput placeholder="Personas máximas simultáneas" icon="/assets/icons/queue-alt.svg" v-model="form.max_concurrent_people" />
                <h2 class="mt-2 mb-1">Tipos de entrada</h2>
                <div class="grid gap-2">
                    <div v-for="(ticket, index) in form.ticket_types" :key="index"
                        class="flex gap-1 h-[60px] bg-gradient-to-r from-gradient1 to-gradient2 text-gradient2 p-[1px] rounded-[10px]">
                        <div
                            class="bg-white w-full h-full rounded-[9px] p-[10px] flex gap-3 justify-between items-center">
                            <div class="flex gap-3">
                                <OcioInput placeholder="Nombre de la entrada" v-model="form.ticket_types[index].name"
                                    icon="/assets/icons/ticket-alt.svg" />
                                <div class="w-[160px]">
                                    <OcioInput placeholder="Precio" v-model="form.ticket_types[index].price"
                                        icon="/assets/icons/euro.svg" />
                                </div>
                            </div>
                            <div v-if="index > 0" @click="form.ticket_types.splice(index, 1)"
                                class="bg-gradient-to-r from-gradient1 to-gradient2 text-gradient2 flex items-center justify-center w-[40px] h-full rounded-[10px]">
                                <img src="/assets/icons/cross-small.svg" alt="icon" class="w-[30px] h-[30px] invert" />
                            </div>
                        </div>
                    </div>
                </div>
                <OcioButton class="mt-3" text="Nuevo tipo de entrada"
                    @click="form.ticket_types.push({ name: null, price: null })" />

                <h2 class="mt-2 mb-1">Imagenes</h2>
                <OcioImages v-model:images="form.images" />
                
            </div>
            <div class="mt-6">
                <h2 class="font-bold mb-2">Contribución a Ocio Local</h2>
                <div class="flex justify-center">
                <div
                    @click="isOpenContributionModal = true"
                    class="mb-4 flex justify-center items-center font-bold bg-gradient-to-r from-teal-500 to-teal-600 underline text-white rounded-[10px] p-[1px] w-[200px] h-[40px]">Por
                    favor, lee esto</div>
                </div>
                <OcioContribution v-model="form.contribution" />
                <div v-if="getCheapestTicket()" class="text-center text-[16px]">
            Por cada <strong>{{ getCheapestTicket().name }}</strong>, Ocio Local recibirá aproximadamente
            {{ (getCheapestTicket().price / 1.0325 * (form.contribution / 100)).toFixed(2) }} €
        </div>
                


            </div>
        </div>
        <div class="flex flex-col gap-1">

        </div>
        <div class="flex flex-col gap-1">
            <h2></h2>
        </div>
        <OcioSubmit class="mb-8">Crear actividad</OcioSubmit>
    </form>
    <OcioModal v-model="isOpenContributionModal" @close="isOpenContributionModal = false">
        <p>Soy Joan, tengo 19 años y soy la unica persona que desarrolla y mantiene esta plataforma. Le dedico
            muchas horas y esfuerzo, por lo que agradecería mucho tu colaboración para poder seguir adelante con
            este proyecto. Si te gusta lo que hago y mi aplicación es util para {{ company.company_name }} puedes
            aportar al menos un
            10% de las ventas de esta actividad a Ocio Local. ¡Gracias! ❤️</p>
    </OcioModal>
</template>
