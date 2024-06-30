<script setup>
import { defineProps, defineEmits, ref, onMounted } from 'vue';



const emits = defineEmits(['update:modelValue']);
const focused = ref(false);
const input = ref(null);

const props = defineProps({
    name: {
        type: String,
        required: true
    },
    modelValue: {
        type: String,
        required: true
    },
    placeholder: {
        type: String,
        required: false
    },
    type: {
        type: String,
        required: false,
        default: 'text'
    },
    icon: {
        type: String,
        required: false
    },
    error: {
        type: String,
        required: false
    },
    autofocus: {
        type: Boolean,
        required: false,
        default: false
    }
})


onMounted(() => {
    if (props.autofocus) {
        input.value.focus();
    }
})


function updateValue(event) {
    emits('update:modelValue', event.target.value);
}

</script>

<template>
    <div class="h-[40px] w-full rounded-[10px] p-[1px] flex items-center bg-gray-200 relative"
        :class="{ 'bg-gradient-to-r from-[#EC48C1] to-[#FED860]': focused }">
        <input
            ref="input"
            class="h-full w-full bg-white rounded-[9px] border-transparent focus:outline-none focus:border-transparent focus:ring-0 p-2 placeholder-gray-200 pl-9"
            :type="type" :placeholder="placeholder" :v-model="value" @focus="focused = true" @blur="focused = false" :autofocus="autofocus"
            @input="updateValue" />
        <img :src="icon" alt="Input icon" class="w-[20px] h-[20px] ml-2 absolute" />
    </div>
</template>