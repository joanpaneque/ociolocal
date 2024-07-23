<script setup>
import { defineProps, ref, defineEmits, computed } from 'vue';
import OcioHour from '@/Components/OcioHour.vue';


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

const weekly_schedule = ref(props.modelValue);
const selectedDay = ref(null);

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

function addHourRange() {
    if (!selectedDay.value) return;
    weekly_schedule.value[selectedDay.value].push({
        start: null,
        end: null
    });
}

function updateHourRange(index, key, hour) {
    console.log(index, key, hour);
    weekly_schedule.value[selectedDay.value][index][key] = hour;
}

</script>

<template>
<div class="flex gap-1">
    <div
        v-for="(day, index) in Object.keys(weekly_schedule)"
        :key="index"
        @click="handleDaySelect(day)"
        class="h-[30px] w-[50px] flex justify-center items-center p-[1px] rounded-[10px] bg-gradient-to-r from-gradient1 to-gradient2 text-gradient2">
        <div class="w-full h-full flex items-center justify-center rounded-[9px] bg-transparent text-white">
            {{ day.substring(0, 3) }}
        </div>
    </div>
</div>

<div class="mt-2 grid gap-2">
    <div
        v-if="selectedDay"
        v-for="(hour, index) in weekly_schedule[selectedDay]"
        class="flex gap-1 h-[60px] bg-gradient-to-r from-gradient1 to-gradient2 text-gradient2 p-[1px] rounded-[10px]">
        <div class="bg-white w-full h-full rounded-[9px] p-[10px] flex gap-3 justify-between items-center">
            <div class="flex gap-3">
                <OcioHour v-model:hour="hour.start" :minHour="index > 0 ? weekly_schedule[selectedDay][index - 1].end : undefined"
                 @change="hour => updateHourRange(index, 'start', hour)" />
                <p class="flex items-center justify-center">hasta</p>
                <OcioHour v-model:hour="hour.end" :minHour="hour.start"
                
                @change="hour => updateHourRange(index, 'end', hour)" />
            </div>
            <div class="bg-gradient-to-r from-gradient1 to-gradient2 text-gradient2 flex items-center justify-center w-[40px] h-full rounded-[10px]">
                <img src="/assets/icons/cross-small.svg" alt="icon" class="w-[30px] h-[30px] invert" />
            </div>
        </div>
    </div>
    <button
        v-if="selectedDay"
        @click="addHourRange"
        class="bg-gradient-to-r from-gradient1 to-gradient2 text-gradient2 px-4 py-2 rounded-[10px]">
        Añadir rango horario
    </button>
</div>

</template>
