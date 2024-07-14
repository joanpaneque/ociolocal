<script setup>
import { ref } from 'vue';
import { router, useForm } from '@inertiajs/vue3';
import GoBackButton from '@/Components/GoBackButton.vue';
import OcioInput from '@/Components/OcioInput.vue';
import OcioImage from '@/Components/OcioImage.vue';

const form = useForm({
    company_name: '',
    company_email: '',
    company_phone: '',
    company_address: '',
    company_nif: '',
    legal_representative_name: '',
    legal_representative_email: '',
    legal_representative_phone: '',
    iban: '',
    image: ''
});

const imageData = ref(null);

</script>

<template>
    <GoBackButton :route="route('users.companies.index', $page.props.auth.user.id)" title="Nueva empresa" />
    <div class="px-[40px] w-full flex flex-col gap-4">
        <div class="flex flex-col gap-1">
            <h2>Datos básicos</h2>
            <OcioInput placeholder="Nombre de la empresa" icon="/assets/icons/briefcase.svg" v-model="form.company_name" autofocus/>
        </div>
        <div class="flex flex-col gap-1">
            <h2>Información de contacto</h2>
            <OcioInput placeholder="Correo electrónico" icon="/assets/icons/at.svg" v-model="form.company_email"/>
            <OcioInput placeholder="Teléfono" icon="/assets/icons/phone.svg" v-model="form.company_phone"/>
            <OcioInput placeholder="Dirección" icon="/assets/icons/marker.svg" v-model="form.company_address"/>
        </div>
        <div class="flex flex-col gap-1">
            <h2>Detalles de registro</h2>
            <OcioInput placeholder="NIF/CIF" icon="/assets/icons/card-person.svg" v-model="form.company_nif"/>
        </div>
        <div class="flex flex-col gap-1">
            <h2>Información del representante legal</h2>
            <OcioInput placeholder="Nombre" icon="/assets/icons/card-person.svg" v-model="form.legal_representative_name"/>
            <OcioInput placeholder="Correo electrónico" icon="/assets/icons/at.svg" v-model="form.legal_representative_email"/>
            <OcioInput placeholder="Teléfono" icon="/assets/icons/phone.svg" v-model="form.legal_representative_phone"/>
        </div>
        <div class="flex flex-col gap-1">
            <h2>Detalles de pago</h2>
            <OcioInput placeholder="IBAN" pattern="\d{4}-\d{4}-\d{4}-\d{4}" icon="/assets/icons/card-person.svg" v-model="form.iban"/>
        </div>
        <div class="flex flex-col gap-1">
            <h2>Logotipo</h2>
            <OcioImage v-model="form.image" :imageValue="imageData" />
        </div>
    </div>
</template>
