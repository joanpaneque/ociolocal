<script setup>
import { defineProps, ref, defineEmits, watch } from 'vue';

const props = defineProps({
    hour: {
        type: String,
        required: false
    },
    minHour: {
        type: String,
        required: false,
        default: '-1:-1'
    },
    disabled: {
        type: Boolean,
        required: false,
        default: false
    }
});

const emit = defineEmits('update:hour');

const hour = ref(props.hour);


const hours = ["00", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23"];

const minutes = ["00", "05", "10", "15", "20", "25", "30", "35", "40", "45", "50", "55"];

const open = ref(false);

const selectedHour = ref(null);
const selectedMinute = ref(null);

function minuteCanBeDisplayed(minute) {
    if (!selectedHour.value) { // si no se ha seleccionado una hora
        if (props.minHour.split(':')[0] === '23') {
            return minute > props.minHour.split(':')[1];
        }
        return true;
    }
    if (selectedHour.value === props.minHour.split(':')[0]) {
        return minute > props.minHour.split(':')[1];
    }

    return true;
}

function handleHourSelect(hour) {

    if (selectedHour.value === hour) {
        selectedHour.value = null;
        emit('update:hour', null);
        return;
    }

    selectedHour.value = hour;

    if (selectedMinute.value) {
        if (!minuteCanBeDisplayed(selectedMinute.value)) {
            handleMinuteSelect(selectedMinute.value);
        }
    }

    if (selectedHour.value && selectedMinute.value) {
        emit('update:hour', `${selectedHour.value}:${selectedMinute.value}`);
    }
}

function handleMinuteSelect(minute) {

    if (selectedMinute.value === minute) {
        selectedMinute.value = null;
        emit('update:hour', null);
        return;
    }

    selectedMinute.value = minute;
    if (selectedHour.value && selectedMinute.value) {
        emit('update:hour', `${selectedHour.value}:${selectedMinute.value}`);
        open.value = false;
    }
}

function handleOpen() {
    if (props.disabled) {
        return;
    }
    open.value = !open.value;
}

// watch if minHour changes
watch(() => props.minHour, () => {
    handleHourSelect(selectedHour.value);
    handleMinuteSelect(selectedMinute.value);
    open.value = false;
});

</script>

<template>
    <div class="relative h-[40px] w-[80px]">
        <div
            @click="handleOpen"
            :class="{
                'cursor-not-allowed opacity-50': props.disabled
            }"
            class="w-full h-full bg-gradient-to-r from-gradient1 to-gradient2 rounded-[10px] flex items-center justify-around p-[1px]">
            <div class="w-full h-full rounded-[9px] flex items-center justify-center"
                :class="selectedHour && selectedMinute ? 'bg-transparent text-white' : 'bg-white text-gradient2'">
                <!-- <div>{{ hour ?? '---' }}</div> -->
                <div v-if="selectedHour && !selectedMinute">
                    {{ selectedHour }}:--
                </div>
                <div v-else-if="!selectedHour && selectedMinute">
                    --:{{ selectedMinute }}
                </div>
                <div v-else-if="selectedHour && selectedMinute">
                    {{ selectedHour }}:{{ selectedMinute }}
                </div>
                <div v-else>
                    --:--
                </div>
                <img
                    :class="{
                        'invert': selectedHour && selectedMinute,
                        'rotate-180': open
                    }"
                    src="/assets/icons/dropdown.svg" alt="icon" class="w-[17px] h-[17px]" />
            </div>
        </div>
        <div
            v-if="open"
            class="absolute h-[140px] w-[100px] bg-gradient-to-r from-gradient1 to-gradient2 rounded-[10px] mt-1 p-[1px] z-50">
            <div class="w-full h-full bg-white rounded-[9px] grid grid-cols-2 gap-1 p-2">
                <div class="grid h-full min-h-fit overflow-scroll">
                    <div v-for="hour in hours" v-show="hour >= minHour.split(':')[0]" @click="handleHourSelect(hour)"
                        :class="selectedHour === hour ? 'bg-gradient-to-r from-gradient1 to-gradient2 text-white' : 'bg-white'"
                        class="h-[30px] w-[30px] flex items-center justify-center rounded-[10px]">
                        {{ hour }}
                    </div>
                </div>
                <div class="grid h-full min-h-fit overflow-scroll">
                    <div v-for="minute in minutes"
                        @click="handleMinuteSelect(minute)"
                        v-show="minuteCanBeDisplayed(minute)"
                        :class="selectedMinute === minute ? 'bg-gradient-to-r from-gradient1 to-gradient2 text-white' : 'bg-white'"
                        class="h-[30px] w-[30px] flex items-center justify-center rounded-[10px]">
                        {{ minute }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>ç