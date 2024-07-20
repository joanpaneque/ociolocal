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
    const porcentaje = 100 * Math.pow(valorAjustado / 100, 1/3);
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
}

</script>

<template>
    <div ref="line" class="w-full h-2 gradient relative flex items-center mt-5">
        <div ref="dragPoint" class="dragpoint w-[25px] h-[30px] bg-white rounded-[10px] border-[1px] border-black absolute" :style="{ left: `${percentage}%` }"></div>
    </div>
</template>

<style scoped>
.gradient {
    border: 1px solid black;
    border-radius: 10px;
    background: linear-gradient(to right, #FF0000, #FF7F00, #FFFF00,  #00FF00, #00FF00, #00FF00, #00FF00, #008500, #008500, #008500, #e100ff, #e100ff, #e100ff);
}

.dragpoint {
    cursor: pointer;
    transform: translateX(-50%);
}
</style>
