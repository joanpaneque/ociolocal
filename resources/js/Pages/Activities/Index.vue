<script setup>
import { defineProps } from 'vue';
import { router } from '@inertiajs/vue3';
import GoBackButton from '@/Components/GoBackButton.vue';
import Section from '@/Components/Section.vue';
import ActivityManagementThumbnail from '@/Components/ActivityManagementThumbnail.vue';
import OcioButton from '@/Components/OcioButton.vue';


const props = defineProps({
    company: {
        type: Object,
        required: true
    },
    upcoming_activities: {
        type: Array,
        required: true
    },
    in_progress_activities: {
        type: Array,
        required: true
    },
    past_activities: {
        type: Array,
        required: true
    }
})
</script>

<template>
    <GoBackButton :route="route('users.companies.show', [$page.props.auth.user.id, company.id])" title="Mis actividades" />
    <div class="px-[40px]">
        <OcioButton text="Crear actividad" @click="router.get(route('users.companies.activities.create', [$page.props.auth.user.id, company.id]))" />
        <Section title="En curso">
            <div class="flex gap-3 overflow-x-auto w-full pb-2">
                <ActivityManagementThumbnail
                    v-for="activity in in_progress_activities"
                    :activity="activity" />
            </div>
        </Section>

        <Section title="Próximamente">
            <div class="flex gap-3 overflow-x-auto w-full pb-2">
                <ActivityManagementThumbnail
                    v-for="activity in upcoming_activities"
                    :activity="activity" />
            </div>
        </Section>
        <Section title="Terminadas">
            <div class="flex gap-3 overflow-x-auto w-full pb-2">
                <ActivityManagementThumbnail
                    v-for="activity in past_activities"
                    :activity="activity" />
            </div>
        </Section>
    </div>
</template>