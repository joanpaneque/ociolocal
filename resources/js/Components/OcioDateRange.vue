<script setup>
import { defineProps, ref, defineEmits } from 'vue';
import 'cally';


const props = defineProps({
    date_start: {
        type: String,
        required: false,
        default: ''
    },
    date_end: {
        type: String,
        required: false,
        default: ''
    }
});

const emit = defineEmits('update:date_start', 'update:date_end');

const selectingSeasonRange = ref(false);
const date_start = ref(props.date_start);
const date_end = ref(props.date_end);
const open = ref(false);
const tentative = ref(null);
const minDate = ref(getCurrentDate());
const calendarValue = ref(null);



function getCurrentDate() {
    return new Date().toISOString().split('T')[0];
}


function onFocus(event) {
    selectingSeasonRange.value = !selectingSeasonRange.value;
    // save the selected date in mysql format
    // transform 'Thu Jul 04 2024 02:00:00 GMT+0200 (hora de verano de Europa central)' to '2024-07-04'
    let date = new Date(event.detail);
    let year = date.getFullYear();
    let month = date.getMonth() + 1;
    let day = date.getDate();
    // add pad ceros
    let mysql_date = year + '-' + (month < 10 ? '0' + month : month) + '-' + (day < 10 ? '0' + day : day);


    if (selectingSeasonRange.value) {
        emit('update:date_start', mysql_date);
        emit('update:date_end', null);
        date_start.value = mysql_date;
        date_end.value = null;
        minDate.value = mysql_date;
    } else {
        emit('update:date_end', mysql_date);
        date_end.value = mysql_date;
        minDate.value = getCurrentDate();
        calendarValue.value = `${date_start.value}/${date_end.value}`;
    }
}

function humanizeDate(date) {
    if (date) {
        let dateArray = date.split('-');
        let year = dateArray[0];
        let month = dateArray[1];
        let day = dateArray[2];
        let months = ['ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic'];
        return day + ' ' + months[month - 1] + ' ' + year;
    } else {
        return '';
    }
}

function handleDateStartClick() {
    tentative.value = date_start.value;
    calendarValue.value = null;

    if (!date_start.value) {
        open.value = !open.value;
    } else {
        selectingSeasonRange.value = false;
        date_start.value = null;
        date_end.value = null;
        emit('update:date_start', null);
        emit('update:date_end', null);
        open.value = !open.value;
        minDate.value = getCurrentDate();

    }
}

function handleDateEndClick() {
    if (date_start.value) {
        open.value = !open.value;
        if (!date_end.value) {
            tentative.value = date_start.value;
        } else {
            // calendarValue.value = `${date_start.value}/${date_end.value}`;
        }
    }
}


</script>

<template>
    <div class="h-[50px] w-full flex gap-3">
        <div
            @click="handleDateStartClick"
            class="w-1/2 bg-gradient-to-r from-gradient1 to-gradient2 rounded-[10px] flex items-center justify-center p-[1px]">
            <div
                style="grid-template-columns: auto 20px;"
                :class="{'bg-transparent': date_start, 'bg-white': !date_start}"
                class="w-full h-full  rounded-[9px] grid gap-1 justify-between items-center px-3">
                <div
                    :class="{'text-white': date_start}"
                    class="flex gap-2 items-center text-[14px] font-semibold">
                    <img src="/assets/icons/calendar-day.svg" alt="icon" class="w-[18px] h-[18px] " :class="{'invert': date_start}"/>
                    <span v-if="!date_start">Inicio</span>
                    <span v-else>{{ humanizeDate(date_start) }}</span>
                </div>
                <div class="flex gap-2 items-center">
                    <img src="/assets/icons/dropdown.svg" alt="icon" class="w-[17px] h-[17px]" :class="{'invert': date_start, 'rotate-180': open && !date_start}"/>
                </div>
            </div>
        </div>
        <div
            @click="handleDateEndClick"
            :class="{'opacity-30': !date_start}"
            class="w-1/2 bg-gradient-to-r from-gradient1 to-gradient2 rounded-[10px] flex items-center justify-center p-[1px]">
            <div
                style="grid-template-columns: auto 20px;"
                :class="{'bg-transparent': date_end, 'bg-white': !date_end}"
                class="w-full h-full rounded-[9px] grid gap-1 justify-between items-center px-3">
                <div
                
                    :class="{'text-white': date_end}"
                    class="flex gap-2 items-center text-[14px] font-semibold">
                    <img src="/assets/icons/calendar-day.svg" alt="icon" class="w-[18px] h-[18px]" :class="{'invert': date_end}"/>
                    <span v-if="!date_end">Final</span>
                    <span v-else>{{ humanizeDate(date_end) }}</span>
                </div>
                <div class="flex gap-2 items-center">
                    <img src="/assets/icons/dropdown.svg" alt="icon" class="w-[17px] h-[17px]" :class="{'invert': date_end, 'rotate-180': date_start}"/>
                </div>
            </div>
        </div>
    </div>
    <div v-if="open" ref="calendar" class="mt-3">
        <calendar-range :tentative="tentative" :min="minDate" :value="calendarValue" class="w-full">
            <svg class="w-[25px] h-[25px]" slot="previous" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="512" height="512"><path fill="#fff" d="M19,11H9l3.29-3.29a1,1,0,0,0,0-1.42,1,1,0,0,0-1.41,0l-4.29,4.3A2,2,0,0,0,6,12H6a2,2,0,0,0,.59,1.4l4.29,4.3a1,1,0,1,0,1.41-1.42L9,13H19a1,1,0,0,0,0-2Z"/></svg>
            <svg class="w-[25px] h-[25px]" slot="next" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="512" height="512"><path fill="#fff" d="M18,12h0a2,2,0,0,0-.59-1.4l-4.29-4.3a1,1,0,0,0-1.41,0,1,1,0,0,0,0,1.42L15,11H5a1,1,0,0,0,0,2H15l-3.29,3.29a1,1,0,0,0,1.41,1.42l4.29-4.3A2,2,0,0,0,18,12Z"/></svg>


            <calendar-month @focusday="onFocus" class="w-full">

            </calendar-month>
        </calendar-range>
    </div>
</template>

<style scoped>

    ::part(button next), ::part(button previous) {
        background: linear-gradient(90deg, var(--gradient1) 0%, var(--gradient2) 100%);
        border-radius: 10px;
        border: none;
        padding: 7px;
    }

    calendar-month {
    --color-accent: var(--gradient2);
    --color-text-on-accent: #ffffff;

  }

  calendar-month ::part(button) {
    border-radius: 3px;
}


</style>