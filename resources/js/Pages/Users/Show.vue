<script setup>
import { router } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import NavigationBar from '@/Components/NavigationBar.vue';
import EnterpriseSection from '@/Components/EnterpriseSection.vue';
import GoBackButton from '@/Components/GoBackButton.vue';

const props = defineProps({
    user: {
        type: Object,
        required: true
    }
})
</script>

<template>
    <GoBackButton :route="route('index')" :occupySpace="false" />
    <div class="px-[40px] z-50">
        <div class="flex flex-col items-center mt-6">
            <img :src="user.avatar" alt="User avatar"
                class="w-[100px] h-[100px] rounded-full mb-2 mt-4 border-2 border-gray-300">
            <h1 class="text-[24px] font-[600] text-center mb-3">{{ user.name }}</h1>
            <div v-if="user.enterprise"
                class="text-[15px] text-white bg-gradient-to-r from-gradient1 to-gradient2 px-3 py-1 font-semibold rounded-2xl flex items-center gap-2">
                <span>Enterprise</span>
                <img src="/assets/icons/crown.svg" alt="Enterprise icon" class="invert w-[20px] h-[20px] inline-block">
            </div>
            <div v-else class="flex items-center flex-col gap-1">
                <div
                    class="text-[15px] w-fit text-black bg-white px-3 py-1 font-semibold rounded-2xl gap-2 border-[1px] border-black">
                    Basic</div>
                <div class="underline text-gray-600">Solicitar cuenta <span
                        class="bg-clip-text text-transparent bg-gradient-to-r from-gradient1 to-gradient2">enterprise</span>
                </div>
            </div>
        </div>
        <!-- :href="route('user.activities', user.id)" -->
        <div class="rect-grid mt-4">
            <EnterpriseSection
                v-if="user.enterprise"
                @click="router.get(route('users.companies.index', user.id))"
                icon="/assets/icons/rocket-lunch.svg"
                title="Mis empresas"
            />

            <EnterpriseSection v-if="user.enterprise" icon="/assets/icons/euro.svg"
                title="Ventas" />
            <EnterpriseSection v-if="user.enterprise" icon="/assets/icons/scan_qr.svg"
                title="Escanear entradas" />
        </div>
    </div>
    <NavigationBar active="profile" />
</template>


<style scoped>
.rect-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
    gap: 15px;
}
</style>