<script setup>
import { defineProps, defineEmits, ref } from 'vue';

const emits = defineEmits(['update:modelValue', 'update:imageData']);

const props = defineProps({
    modelValue: {
        type: Object,
        required: true
    },
    imageValue: {
        type: String,
        required: false
    }
})

const input = ref(null);
const imageData = ref(null);

function updateValue(event) {
    const file = event.target.files[0];
    emits('update:modelValue', file);
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            emits('update:imageData', e.target.result);
            imageData.value = e.target.result;
        }
        reader.readAsDataURL(file);
    }
}
</script>

<template>
    <input type="file" @change="updateValue" class="hidden" ref="input" />
    <div
        :class="{ 'bg-gradient-to-r from-gradient1 to-gradient2': imageData }"
        class="w-full h-[120px] bg-gray-200 rounded-[9px] flex items-center justify-center px-[1px] py-[1px]">
        <div class="w-full h-full bg-white rounded-[8px] flex items-center justify-between px-1 py-1 gap-1">
            <div class="w-[50%] h-full flex items-center justify-center rounded-[6px] border-[1px] border-slate-400">
                <img :src="imageData ?? '/assets/default/no-image.jpeg'" alt="Preview" class="w-full h-full rounded-[5px] object-cover" />
            </div>
            <div
                @click="$refs.input.click()"
                class="w-[50%] h-full flex flex-col items-center justify-center bg-slate-200 rounded-[6px] border-[1px] border-slate-400">
                <img src="/assets/icons/add-image.svg" alt="Upload icon" class="w-[30px] h-[30px]" />
                <h2>Sube tu logotipo</h2>
            </div>
        </div>
    </div>
</template>
