<script setup>
import { defineProps, ref, defineEmits, onMounted, onUnmounted } from 'vue';

const props = defineProps({
    modelValue: {
        type: String,
        required: true,
        default: '1'
    }
});

const emit = defineEmits(['update:modelValue']);

const dragPoint = ref(null);
const line = ref(null);


function calcularPorcentaje(valorAjustado) {
    const porcentaje = 100 * Math.pow(valorAjustado / 100, 1 / 3);
    return porcentaje;
}

const percentage = ref(calcularPorcentaje(props.modelValue));

onMounted(() => {
    dragPoint.value.addEventListener('mousedown', startDragging);
    dragPoint.value.addEventListener('touchstart', startDragging);
});

// onUnmounted(() => {
//     dragPoint.value.removeEventListener('mousedown', startDragging);
//     dragPoint.value.removeEventListener('touchstart', startDragging);
// });

function startDragging(event) {
    event.preventDefault();
    document.addEventListener('mousemove', drag);
    document.addEventListener('mouseup', stopDragging);
    document.addEventListener('touchmove', drag);
    document.addEventListener('touchend', stopDragging);
}

function drag(event) {
    const clientX = event.touches ? event.touches[0].clientX : event.clientX;
    const rect = line.value.getBoundingClientRect();
    let newLeft = clientX - rect.left;

    if (newLeft < 0) {
        newLeft = 0;
    } else if (newLeft > rect.width) {
        newLeft = rect.width;
    }

    dragPoint.value.style.left = `${newLeft}px`;

    percentage.value = newLeft / rect.width * 100;


    // Aquí implementamos la función estimada
    const valorAjustado = 100 * Math.pow(percentage.value / 100, 3); // Ajusta los valores de 100 y 3 según necesites

    emit('update:modelValue', `${valorAjustado.toFixed(2)}`);
}

function stopDragging() {
    document.removeEventListener('mousemove', drag);
    document.removeEventListener('mouseup', stopDragging);
    document.removeEventListener('touchmove', drag);
    document.removeEventListener('touchend', stopDragging);

    // redondear a 5 decimales
    let contribution = parseFloat(props.modelValue).toFixed(2);
    // si el valor es 12.07, el valor ajustado es 12
    // si el valor es 12.23, el valor ajustado es 12
    // si el valor es 12.24, el valor ajustado es 12
    // si el valor es 12.25, el valor ajustado es 12.5
    // si el valor es 12.50, el valor ajustado es 12.5
    // si el valor es 12.74, el valor ajustado es 12.5
    // si el valor es 12.75, el valor ajustado es 13

    // calculo:
    

    // redondear a 0.5
    // contribution = (Math.round(contribution * 2) / 2).toFixed(2);
    // redondear a 0.25
    contribution = (Math.round(contribution * 4) / 4).toFixed(2);

    percentage.value = calcularPorcentaje(contribution);
    emit('update:modelValue', contribution);
}

const contributionEmojis = {
    '0': '😢😭',
    '1': '😢',
    '2': '😐',
    '5': '🙂',
    '10': '😄',
    '15': '😆',
    '20': '😁',
    '25': '😁❤️',
    '35': '😁❤️🎉❤️😁',
    // explosion
    '50': '💥❤️😁❤️💥',
    '75': '💥💥❤️💥💥',
    '85': '💥💥💥💥💥',
    '90': '🤯💥💥💥🤯',
    '95': '🤯🤯💥🤯🤯',
    '100': '🤯🤯🤯🤯🤯'
}


function getContributionEmoji(contribution) {
    let contribution_emojis = Object.keys(contributionEmojis);
    let closest = contribution_emojis.reduce((prev, curr) => Math.abs(curr - contribution) <= Math.abs(prev - contribution) ? curr : prev);
    return contributionEmojis[closest];
}

function addContribution(value) {
    // can be negative or positive
    let contribution = parseFloat(props.modelValue) + value;
    // check if contribution is between 0 and 100
    if (contribution < 0 || contribution > 100) {
        return;
    }



    // redondear a 5 decimales
    contribution = contribution.toFixed(2);
    // redondear a 0.25
    contribution = (Math.round(contribution * 4) / 4).toFixed(2);
    percentage.value = calcularPorcentaje(contribution);
    emit('update:modelValue', contribution);
}
</script>

<template>
            <div class="flex justify-center gap-3">
            <div
                @click="addContribution(-0.25)"
                class="text-[20px] bg-gradient-to-r from-gradient1 to-gradient2 px-[10px] rounded-[10px] text-white"
            >-0,25%</div>
            <div
                @click="addContribution(0.25)"
                class="text-[20px] bg-gradient-to-r from-gradient1 to-gradient2 px-[10px] rounded-[10px] text-white"
            >+0,25%</div>
        </div>
    <div ref="line" class="w-full h-2 gradient relative flex items-center mt-5">
        <div ref="dragPoint"
            class="dragpoint w-[25px] h-[30px] bg-white rounded-[10px] border-[1px] border-black absolute"
            :style="{ left: `${percentage}%` }"></div>
    </div>
    <div class="text-[40px] grid justify-center">
        <div class="text-center">
            {{ modelValue.replace('.', ',') }} %
        </div>
        <div class="flex justify-center">
            <div>{{ getContributionEmoji(parseInt(modelValue)) }}</div>
        </div>

    </div>
</template>

<style scoped>
.gradient {
    border: 1px solid black;
    border-radius: 10px;
    background: linear-gradient(to right, #FF0000, #FF7F00, #FFFF00, #00FF00, #00FF00, #00FF00, #00FF00, #008500, #008500, #008500, #e100ff, #e100ff, #e100ff);
}

.dragpoint {
    cursor: pointer;
    transform: translateX(-50%);
}
</style>
