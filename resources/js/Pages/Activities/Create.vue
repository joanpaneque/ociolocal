<script setup>
import { ref, defineProps } from 'vue';
import { router, useForm } from '@inertiajs/vue3';
import GoBackButton from '@/Components/GoBackButton.vue';
import OcioInput from '@/Components/OcioInput.vue';
import OcioImage from '@/Components/OcioImage.vue';
import OcioSubmit from '@/Components/OcioSubmit.vue';
import OcioSwitch from '@/Components/OcioSwitch.vue';
import 'cally';

const props = defineProps({
    company: {
        type: Object,
        required: true
    }
});

const form = useForm({
    'activity_name': '',
    'season': true,
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
            <calendar-range>
  <calendar-month></calendar-month>
</calendar-range>
        </div>
        <div class="flex flex-col gap-1">
            <h2>Información de contacto</h2>
            <OcioInput placeholder="Correo electrónico" icon="/assets/icons/at.svg" v-model="form.company_email" type="email"/>
            <span v-if="form.errors.company_email" class="text-red-600">{{ form.errors.company_email }}</span>
            <OcioInput placeholder="Teléfono" icon="/assets/icons/phone.svg" v-model="form.company_phone" type="tel"/>
            <span v-if="form.errors.company_phone" class="text-red-600">{{ form.errors.company_phone }}</span>
            <OcioInput placeholder="Dirección" icon="/assets/icons/marker.svg" v-model="form.company_address"/>
            <span v-if="form.errors.company_address" class="text-red-600">{{ form.errors.company_address }}</span>
        </div>
        <div class="flex flex-col gap-1">
            <h2>Detalles de registro</h2>
            <OcioInput placeholder="NIF/CIF" icon="/assets/icons/card-person.svg" v-model="form.company_nif"/>
            <span v-if="form.errors.company_nif" class="text-red-600">{{ form.errors.company_nif }}</span>
        </div>
        <div class="flex flex-col gap-1">
            <h2>Información del representante legal</h2>
            <OcioInput placeholder="Nombre" icon="/assets/icons/card-person.svg" v-model="form.legal_representative_name"/>
            <span v-if="form.errors.legal_representative_name" class="text-red-600">{{ form.errors.legal_representative_name }}</span>
            <OcioInput placeholder="Correo electrónico" icon="/assets/icons/at.svg" v-model="form.legal_representative_email" type="email"/>
            <span v-if="form.errors.legal_representative_email" class="text-red-600">{{ form.errors.legal_representative_email }}</span>
            <OcioInput placeholder="Teléfono" icon="/assets/icons/phone.svg" v-model="form.legal_representative_phone" type="tel"/>
            <span v-if="form.errors.legal_representative_phone" class="text-red-600">{{ form.errors.legal_representative_phone }}</span>
        </div>
        <div class="flex flex-col gap-1">
            <h2>Detalles de pago</h2>
            <OcioInput placeholder="IBAN" icon="/assets/icons/card-person.svg" v-model="form.iban"/>
            <span v-if="form.errors.iban" class="text-red-600">{{ form.errors.iban }}</span>
        </div>
        <div class="flex flex-col gap-1">
            <h2>Logotipo</h2>
            <OcioImage v-model="form.image" :imageValue="imageData" />
            <span v-if="form.errors.image" class="text-red-600">{{ form.errors.image }}</span>
        </div>
        <OcioSubmit class="mb-8">Crear empresa</OcioSubmit>
    </form>
</template>
