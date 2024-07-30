ç
<script setup>
import { defineProps, ref, defineEmits, computed } from 'vue';
import OcioHour from '@/Components/OcioHour.vue';
import OcioSwitch from '@/Components/OcioSwitch.vue';


const props = defineProps({
    modelValue: {
        type: Object,
        required: true,
        default: () => ({
            monday: [],
            tuesday: [],
            wednesday: [],
            thursday: [],
            friday: [],
            saturday: [],
            sunday: []
        })
    }
});

const emit = defineEmits(['update:modelValue']);

const weekly_schedule = ref(props.modelValue);
const selectedDay = ref(null);
const hourRange = ref(false);

const translations = {
    monday: 'Lunes',
    tuesday: 'Martes',
    wednesday: 'Miércoles',
    thursday: 'Jueves',
    friday: 'Viernes',
    saturday: 'Sábado',
    sunday: 'Domingo'
};

function handleDaySelect(day) {
    if (selectedDay.value === day) {
        selectedDay.value = null;
        return;
    }
    selectedDay.value = null
    setTimeout(() => {
        selectedDay.value = day;
    }, 0);
}

function canAddHourRange() {
    if (!hourRange.value) return false;
    if (!selectedDay.value) return false;

    return weekly_schedule.value[selectedDay.value].every(hour => hour.start && hour.end);
}



function addHourRange() {
    if (!selectedDay.value) return;

    if (!canAddHourRange()) return;

    weekly_schedule.value[selectedDay.value].push({
        start: null,
        end: null
    });
}

function canAddIndividualHour() {
    if (hourRange.value) return false;
    if (!selectedDay.value) return false;

    // check if all hours have a start
    return weekly_schedule.value[selectedDay.value].every(hour => hour.start);
}

function addIndividualHour() {
    if (!selectedDay.value) return;

    if (!canAddIndividualHour()) return;

    weekly_schedule.value[selectedDay.value].push({
        start: null,
        end: null
    });
}

function updateHourRange(index, key, hour) {
    console.log(index, key, hour);
    weekly_schedule.value[selectedDay.value][index][key] = hour;
}

function deleteHourRange(index) {
    weekly_schedule.value[selectedDay.value].splice(index, 1);
}

function setAllEndHoursToNull() {
    for (const day in weekly_schedule.value) {
        weekly_schedule.value[day].forEach(hour => {
            hour.end = null;
        });
    }
    emit('update:modelValue', weekly_schedule.value);
}



</script>

<template>
    <OcioSwitch @change="setAllEndHoursToNull" v-model="hourRange" class="mb-4" first="Horas individuales"
        second="Rangos horarios" />
    <div class="flex gap-1">
        <div v-for="(day, index) in Object.keys(weekly_schedule)" :key="index" @click="handleDaySelect(day)"
            :class="weekly_schedule[day].length ? 'bg-gradient-to-r from-gradient1 to-gradient2' : 'bg-gray-400'"
            class="h-[30px] w-[50px] flex justify-center items-center p-[1px] rounded-[10px] text-gradient2">
            <div :class="selectedDay === day ? 'bg-transparent text-white' : weekly_schedule[day].length ? 'bg-white text-gradient2' : 'bg-white text-gray-400'"
                class="w-full h-full flex items-center justify-center rounded-[9px]">
                {{ translations[day].substring(0, 3) }}
            </div>
        </div>
    </div>

    <div class="mt-2 grid gap-2">
        <div v-if="selectedDay" v-for="(hour, index) in weekly_schedule[selectedDay]"
            class="flex gap-1 h-[60px] bg-gradient-to-r from-gradient1 to-gradient2 text-gradient2 p-[1px] rounded-[10px]">
            <div class="bg-white w-full h-full rounded-[9px] p-[10px] flex gap-3 justify-between items-center">
                <div class="flex gap-3">
                    <OcioHour v-model:hour="hour.start"
                        :minHour="index > 0 ? (hourRange ? weekly_schedule[selectedDay][index - 1].end : weekly_schedule[selectedDay][index - 1].start) : undefined"
                        @change="hour => updateHourRange(index, 'start', hour)" />
                    <p v-if="hourRange" class="flex items-center justify-center">hasta</p>
                    <OcioHour v-if="hourRange" v-model:hour="hour.end" :minHour="hour.start"
                        @change="hour => updateHourRange(index, 'end', hour)" />
                </div>
                <div @click="deleteHourRange(index)"
                    class="bg-gradient-to-r from-gradient1 to-gradient2 text-gradient2 flex items-center justify-center w-[40px] h-full rounded-[10px]">
                    <img src="/assets/icons/cross-small.svg" alt="icon" class="w-[30px] h-[30px] invert" />
                </div>
            </div>
        </div>
        <div v-if="selectedDay" class="w-full">
            <button v-if="hourRange" @click="addHourRange"
                :disabled="!canAddHourRange()"
                class="w-full text-white bg-gradient-to-r from-gradient1 to-gradient2 px-4 py-2 rounded-[10px] disabled:opacity-50">
                Añadir rango horario para el {{ translations[selectedDay].toLowerCase() }}
            </button>
            <button v-else @click="addIndividualHour" :disabled="!canAddIndividualHour()"
                class="w-full text-white bg-gradient-to-r from-gradient1 to-gradient2 px-4 py-2 rounded-[10px] disabled:opacity-50">
                Añadir hora individual para el {{ translations[selectedDay].toLowerCase() }}
            </button>
        </div>

    </div>

</template>
