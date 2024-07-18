<script setup>
import { defineProps, ref, defineEmits } from 'vue';

const props = defineProps({
    first: {
        type: String,
        required: false,
        default: 'Option 1'
    },
    second: {
        type: String,
        required: false,
        default: 'Option 2'
    },
    modelValue: {
        type: Boolean,
        required: true
    }
});

const emit = defineEmits('update:modelValue');

const isChecked = ref(props.modelValue);

function updateValue() {
    isChecked.value = !isChecked.value;
    emit('update:modelValue', isChecked.value);
}


</script>

<template>
    <div class="relative rounded-[10px] overflow-hidden">
        <div class="w-full h-[50px] bg-gradient-to-r from-gradient1 to-gradient2  p-[1px] flex items-center justify-center" @click="updateValue">
            <div class="w-full h-full bg-white rounded-[9px]">

            </div>
        </div>
        <div
            :class="{'checked': isChecked}"
            class="switch absolute w-[50%] h-[50px] bg-gradient-to-r from-gradient1 to-gradient2 rounded-[10px]">
        </div>
        <div class="absolute w-full h-[50px] grid grid-cols-2 left-0 top-0 pointer-events-none">
            <div
                :class="{'text-gradient2': isChecked, 'text-white': !isChecked}"
                class="flex items-center justify-center font-semibold">
                {{ first }}
            </div>
            <div
                :class="{'text-gradient2': !isChecked, 'text-white': isChecked}"
                class="flex items-center justify-center font-semibold">
                {{ second }}
            </div>
        </div>
    </div>

</template>

<style scoped>
.switch {
    left: 0;
    top: 0;
    transition: left 0.2s ease-in-out;
}

.switch.checked {
    left: 50%;
    transition: left 0.2s ease-in-out;
}


</style>