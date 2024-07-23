<script setup>
import { defineProps, ref, defineEmits, computed } from 'vue';
import OcioHour from '@/Components/OcioHour.vue';
import OcioButton from '@/Components/OcioButton.vue';

const emit = defineEmits(['update:hours_monday', 'update:hours_tuesday', 'update:hours_wednesday', 'update:hours_thursday', 'update:hours_friday', 'update:hours_saturday', 'update:hours_sunday']);

const props = defineProps({
    hours_monday: { type: Array, default: () => [] },
    hours_tuesday: { type: Array, default: () => [] },
    hours_wednesday: { type: Array, default: () => [] },
    hours_thursday: { type: Array, default: () => [] },
    hours_friday: { type: Array, default: () => [] },
    hours_saturday: { type: Array, default: () => [] },
    hours_sunday: { type: Array, default: () => [] }
});

const selected_day = ref('monday');

const dayRefs = {
    monday: ref(props.hours_monday),
    tuesday: ref(props.hours_tuesday),
    wednesday: ref(props.hours_wednesday),
    thursday: ref(props.hours_thursday),
    friday: ref(props.hours_friday),
    saturday: ref(props.hours_saturday),
    sunday: ref(props.hours_sunday)
};

const days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
const days_translated = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

const currentHours = computed(() => dayRefs[selected_day.value].value);

function handleDaySelect(day) {
    selected_day.value = selected_day.value === day ? null : day;
}

function handleDeleteHour(day, index) {
    dayRefs[day].value.splice(index, 1);
    emit(`update:hours_${day}`, dayRefs[day].value);
}

function addHour(day) {
    dayRefs[day].value.push({ start: null, end: null });
    emit(`update:hours_${day}`, dayRefs[day].value);
}

function canAddHour(day) {
    if (!day) return false;
    return dayRefs[day].value.length === 0 || dayRefs[day].value.every(hour => hour.start && hour.end);
}



</script>

<template>
    <div class="flex gap-1">
        <div v-for="day in days" :key="day" @click="handleDaySelect(day)"
            :class="dayRefs[day].value.length || selected_day === day ? 'bg-gradient-to-r from-gradient1 to-gradient2 text-gradient2' : 'bg-gray-400 text-gray-400'"
            class="h-[30px] w-[50px] flex justify-center items-center p-[1px] rounded-[10px]">
            <div :class="selected_day === day ? 'bg-transparent text-white' : 'bg-white'"
                class="w-full h-full flex items-center justify-center rounded-[9px]">
                {{ days_translated[days.indexOf(day)].substring(0, 3) }}
            </div>
        </div>
    </div>
    <div class="mt-2 grid gap-2">
        <div v-if="selected_day" v-for="(hour, index) in currentHours" :key="index" class="flex gap-1 h-[60px] bg-gradient-to-r from-gradient1 to-gradient2 text-gradient2 p-[1px] rounded-[10px]">
            <div class="bg-white w-full h-full rounded-[9px] p-[10px] flex gap-3 justify-between items-center">
                <div class="flex gap-3">
                    <OcioHour v-model:hour="currentHours[index].start" :minHour="index === 0 ? '-1:-1' : currentHours[index - 1].end" />
                    <p class="flex items-center justify-center">hasta</p>
                    <OcioHour v-model:hour="currentHours[index].end" :minHour="hour.start" :disabled="!hour.start" />
                </div>
                <div @click="handleDeleteHour(selected_day, index)"
                    class="bg-gradient-to-r from-gradient1 to-gradient2 text-gradient2 flex items-center justify-center w-[40px] h-full rounded-[10px]">
                    <img src="/assets/icons/cross-small.svg" alt="icon" class="w-[30px] h-[30px] invert" />
                </div>
            </div>
        </div>
        <OcioButton v-if="selected_day" text="Añadir rango horario" @click="addHour(selected_day)" :disabled="!canAddHour(selected_day)" />
    </div>
</template>
