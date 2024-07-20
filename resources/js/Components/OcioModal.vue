<script setup>
import { defineProps, defineEmits } from 'vue';

const emit = defineEmits(['close']);

const props = defineProps({
    modelValue: {
        type: Boolean,
        default: false,
    }
});

</script>

<template>
    <div class="custom-modal-container" v-if="props.modelValue" @click="emit('close')">
        <div class="custom-modal" @click.stop>
            <main>
                <slot></slot>
            </main>
            <footer>
                <button @click="emit('close')">Entendido</button>
                <!-- <button @click="emit('accept')">Acceptar</button> -->
            </footer>
        </div>
    </div>
</template>

<style scoped>
.custom-modal-container {
    position: absolute;
    top: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.3);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
}

.custom-modal {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    width: 100%;
    max-width: 500px;
    margin: 30px;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.custom-modal main {
    min-height: 100px;
}

.custom-modal-container footer {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 15px;
}

.custom-modal-container footer button {
    padding: 5px;
    background: #fa3c3c;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
}

.custom-modal-container footer button:first-child {
    background: #01599cbb;
}

</style>