<script setup>
import { defineProps, ref, computed } from 'vue';
import GoBackButton from '@/Components/GoBackButton.vue';
import NavigationBar from '@/Components/NavigationBar.vue';
import OcioButton from '@/Components/OcioButton.vue';

const props = defineProps({
    activity: {
        type: Object,
        required: true
    }
});

const ticket_types = ref(JSON.parse(props.activity.ticket_types).map(ticket => ({ ...ticket, quantity: 0 })));

const isThereAnyTicketSelected = computed(() => ticket_types.value.some(ticket => ticket.quantity > 0));

const sumPrices = computed(() => ticket_types.value.reduce((acc, ticket) => acc + ticket.price * ticket.quantity, 0));

</script>

<template>
    <NavigationBar>
        <div class="h-[75px] px-5 py-3 shadow-inner flex justify-between" v-if="isThereAnyTicketSelected">
            <div class="h-full flex items-center gap-2 text-[18px]">
                <div>TOTAL:</div>
                <div class="font-bold">{{ sumPrices.toFixed(2).toString().replaceAll(".",",") }}€</div>
            </div>
            <div class="w-[150px]">
                <OcioButton text="Comprar" />
            </div>
        </div>
    </NavigationBar>
    <GoBackButton :route="route('index')" :title="activity.activity_name" />
    <div class="h-[240px] ">
        <img :src="activity.images[0].image.url" alt="Activity image" class="h-full w-full object-cover"/>
    </div>
    <div class="px-[40px] pb-[200px]">
        <h1 class="text-[24px] font-[600] text-black mt-[20px] flex gap-3 items-center">
            <img src="/assets/icons/ticket.svg" alt="Ticket icon" class="w-[30px] h-[30px]">
            {{ activity.activity_name }}
        </h1>
        <h4 class="text-[15px] text-[#7F7F7F] mt-[7px] flex items-center gap-1">
            {{ activity.company.company_name }}
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 0L8.76688 2.14555L11.4995 1.63769L11.4739 4.417L13.8937 5.78446L12.0875 7.89707L13.0622 10.5L10.3206 10.9574L9.39414 13.5778L7 12.166L4.60586 13.5778L3.67936 10.9574L0.937822 10.5L1.91248 7.89707L0.106346 5.78446L2.52611 4.417L2.50049 1.63769L5.23312 2.14555L7 0Z" fill="url(#paint0_linear_198_2)"/>
                <g clip-path="url(#clip0_198_2)">
                    <path d="M5.9373 10.0266C5.76698 10.0267 5.60364 9.94772 5.48331 9.8071L4.11077 8.20639C3.96308 8.03403 3.96308 7.75464 4.11077 7.58228C4.2585 7.40998 4.49798 7.40998 4.64571 7.58228L5.9373 9.08914L9.35429 5.10265C9.50202 4.93034 9.7415 4.93034 9.88924 5.10265C10.0369 5.275 10.0369 5.55439 9.88924 5.72675L6.39128 9.8071C6.27095 9.94772 6.10761 10.0267 5.9373 10.0266Z" fill="white"/>
                </g>
                <defs>
                    <linearGradient id="paint0_linear_198_2" x1="7" y1="0" x2="7" y2="14" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#86D887"/>
                        <stop offset="1" stop-color="#2DAFA6"/>
                    </linearGradient>
                    <clipPath id="clip0_198_2">
                        <rect width="6" height="7" fill="white" transform="translate(4 4)"/>
                    </clipPath>
                </defs>
            </svg>
        </h4>
        <p class="font-medium mt-3 text-gray-500">
            {{ activity.description }}
        </p>
        <div class="mt-5">
            <h2 class="font-bold mb-3">Selecciona tus entradas</h2>
            <div class="grid gap-3">
                <div v-for="(ticket, index) in ticket_types" :key="index" class="border border-gray-400 rounded-[10px] grid bg-gray-400 overflow-hidden gap-[1px]" >
                    <div class="flex p-5 bg-white justify-between">
                        <div class="pr-2">{{ ticket.name }}</div>
                        <div class="border-l border-gray-400 flex pl-5 items-center">
                            {{ ticket.price.toFixed(2).toString().replace(".",",") }}<span>€</span>
                        </div>
                    </div>
                    <div class="bg-white flex px-3 py-3 items-center justify-between">
                        <div>
                            {{ ticket.quantity ?? 0 }} {{ ticket.quantity === 1 ? 'entrada' : 'entradas' }}
                        </div>
                        <div class="flex gap-2">
                            <div
                                @click="ticket.quantity === 0 ? null : ticket.quantity--"
                                class="text-[24px] font-bold w-[35px] h-[35px] bg-gradient-to-r from-gradient1 to-gradient2 rounded-[10px] text-white flex items-center justify-center">
                                -
                            </div>
                            <div
                                @click="ticket.quantity++"
                                class="text-[24px] font-bold w-[35px] h-[35px] bg-gradient-to-r from-gradient1 to-gradient2 rounded-[10px] text-white flex items-center justify-center">
                                +
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>