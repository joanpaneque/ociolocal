<script setup>
import { defineProps, ref, defineEmits, onMounted } from 'vue';
import OcioButton from '@/Components/OcioButton.vue';

const props = defineProps({
    images: {
        type: Array,
        required: true,
        default: () => []
    }
});
const emit = defineEmits(['update:images', 'update:base64images']);
const images = ref([...props.images]);
const base64images = ref([]);
const upload = ref(null);

const showingImage = ref(0);

const galleryOpen = ref(false);

const deletedImage = ref(false);

const deletedHash = ref("");

function updateValue(event) {
    const files = Array.from(event.target.files);
    files.forEach(file => {
        const reader = new FileReader();
        reader.onload = (e) => {
            images.value.push(file);
            base64images.value.push(e.target.result);
            emit('update:images', images.value);
            emit('update:base64images', base64images.value);
        }
        reader.readAsDataURL(file);
    });
    event.target.value = '';
}

function fillDefaultImages(base64images) {
    const defaultImage = "/assets/default/no-image.jpeg";

    let filledImages = [...base64images];

    while (filledImages.length < 3) {
        filledImages.push(defaultImage);
    }

    filledImages = filledImages.slice(0, 3);

    return filledImages;
}

function removeImage(index) {
    images.value.splice(index, 1);
    base64images.value.splice(index, 1);
    emit('update:images', images.value);
    emit('update:base64images', base64images.value);
    showingImage.value = images.value.length - 1;
    deletedImage.value = false;
    let hash = Math.random().toString(36).substring(7);
    setTimeout(() => {
        deletedImage.value = true;
        deletedHash.value = hash;
    });
    setTimeout(() => {
        if (deletedHash.value === hash) {
            deletedImage.value = false;
        }
    }, 5000);
}

function setupHoverEffects() {
    const imgElements = document.querySelectorAll('.image-preview img');

    imgElements.forEach((img, index) => {
        img.addEventListener('mouseenter', () => {
            if (index === 2) {
                imgElements[0].style.zIndex = '1';
            }
        });

        img.addEventListener('mouseleave', () => {
            if (index === 2) {
                imgElements[0].style.zIndex = '3';
            }
        });
    });
}

onMounted(() => {
    setupHoverEffects();
});

function openImage(index) {
    galleryOpen.value = true;
    if (index < 0 || index >= images.value.length) {
        showingImage.value = 0;
        return;
    }
    showingImage.value = index;
}

function nextImage() {
    showingImage.value = (showingImage.value + 1) % images.value.length;
}

function previousImage() {
    showingImage.value = (showingImage.value - 1 + images.value.length) % images.value.length;
}

</script>

<template>
    <div class="fixed bg-[#00000090] w-full h-full z-50 top-0 left-0 grid custom-rows-header" v-if="galleryOpen">
        <header class="flex justify-end w-full h-full">
            <div class="h-full" @click="galleryOpen = false">
                <img src="/assets/icons/cross-small.svg" alt="Close" class="w-full h-full cursor-pointer invert" />
            </div>
        </header>
        <div class="h-full flex items-center">
            <div class="px-[20px]">
                <div v-if="images.length">
                    <img :src="base64images[showingImage]" alt="Preview"
                        class="w-full h-full object-contain rounded-[10px] shadow-2xl border-[3px] border-gradient2" />
                    <div class="mt-[25px] flex justify-between">
                        <div class="w-[45px] h-[45px]" @click="previousImage">
                            <img src="/assets/icons/angle-circle-right.svg" alt="Left"
                                class="w-full h-full cursor-pointer invert rotate-180" />
                        </div>
                        <div
                            class="flex items-center justify-center bg-red-500 w-[45px] h-[45px] rounded-full font-bold text-white border-[2px] border-white">
                            <img src="/assets/icons/trash.svg" alt="Delete" class="w-[25px] h-[25px] invert"
                                @click="removeImage(showingImage)" />
                        </div>
                        <div class="w-[45px] h-[45px]" @click="nextImage">
                            <img src="/assets/icons/angle-circle-right.svg" alt="Right"
                                class="w-full h-full cursor-pointer invert" />
                        </div>
                    </div>
                </div>
                <div v-else class="w-full h-full flex justify-center items-center text-white font-semibold text-2xl">
                    No hay imágenes.
                </div>
                <div :class="{ 'deleted-image': deletedImage, 'hidden': !deletedImage }"
                    class="absolute bottom-[5px] right-[5px] w-fit h-[30px] bg-red-500 z-40 rounded-[10px] pointer-events-none text-white flex justify-center items-center px-3 py-2">
                    Imagen eliminada.
                </div>
            </div>
            <div>

            </div>
        </div>
    </div>
    <div class="relative">
        <div
            class="image-preview flex w-[100%] p-[1px] bg-gradient-to-r from-gradient1 to-gradient2 rounded-[10px] overflow-hidden">
            <img v-for="(image, index) in fillDefaultImages(base64images)" :key="index" :src="image" alt="Preview"
                class="rounded-[10px] object-cover cursor-pointer" @click="openImage(index)" />
        </div>
        <div
            class="absolute bottom-[5px] right-[5px] w-fit h-[30px] bg-gray-200 z-40 rounded-[10px] pointer-events-none text-gray-600 flex justify-center items-center px-3 py-2">
            {{ images.length }} {{ images.length == 1 ? 'imagen' : 'imágenes' }}
        </div>
    </div>
    <OcioButton class="mt-2" text="Subir imágenes" icon="/assets/icons/add-image.svg"
        @click="() => $refs.upload.click()" />
    <input type="file" @change="updateValue" ref="upload" multiple class="hidden" accept="image/*" />
</template>

<style scoped>
.deleted-image {
    opacity: 1;
    animation: deleted-image 5s forwards;
}

@keyframes deleted-image {
    from {
        opacity: 1;
    }

    to {
        opacity: 0;
    }
}


.custom-rows-header {
    grid-template-rows: 50px 1fr;
}

.image-preview {
    --overlapping: 48px;
}

.image-preview img {
    width: calc(100% / 3 + (var(--overlapping) / 3));
    height: 100px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border: 1px solid #ddd;
}

.image-preview img:nth-child(1) {
    z-index: 3;
}

.image-preview img:nth-child(2) {
    transform: translateX(calc(var(--overlapping) / -2));
    z-index: 2;
}

.image-preview img:nth-child(3) {
    transform: translateX(calc(var(--overlapping) / -1));
    z-index: 1;
}

.image-preview img:hover {
    z-index: 4;
}
</style>
