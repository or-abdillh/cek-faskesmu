<template>
    <section>
        <!-- main -->
        <main>
            <!-- categories -->
            <section class="flex flex-wrap md:flex-nowrap gap-2 md:gap-5 text-gray-700 border-b border-gray-200 pb-4 mb-8">
                <template v-for="category in categories" :key="category.id">
                    <button @click="active = category.name"
                        :class="active === category.name ? 'bg-green-300' : 'bg-green-50'"
                        class="border px-6 py-2 rounded-full duration-300">
                        {{ category.name }}
                        <span class="text-xs text-gray-500">{{ category.count }}</span>
                    </button>
                </template>
            </section>

            <!-- items -->
            <section class="md:columns-2">
                <!-- Facility -->
                <template v-if="active === 'Faskes' || active === 'Semua'" v-for="facility in props.favorites?.facility"
                    :key="facility.id">
                    <FacilityCard :facility="facility" class="break-inside-avoid mb-4 border border-gray-200">
                    </FacilityCard>
                </template>

                <!-- service -->
                <template v-if="active === 'Layanan' || active === 'Semua'" v-for="service in props.favorites?.service"
                    :key="service.id">
                    <ServiceDrugCard :use-review="false" :data="service" type="App\Models\Service"
                        class="break-inside-avoid mb-4 border border-gray-200"></ServiceDrugCard>
                </template>

                <!-- drug -->
                <template v-if="active === 'Obatan' || active === 'Semua'" v-for="drug in props.favorites?.drug"
                    :key="drug.id">
                    <ServiceDrugCard :use-review="false" :data="drug" type="App\Models\Drug"
                        class="break-inside-avoid mb-4 border border-gray-200">
                    </ServiceDrugCard>
                </template>
            </section>
        </main>
    </section>
</template>

<script setup>

import { ref } from 'vue'
import FacilityCard from '@/Components/card/FacilityCard.vue'
import ServiceDrugCard from '@/Components/card/ServiceDrugCard.vue'

const props = defineProps({
    favorites: Object
})

const active = ref('Semua')

const categories = [
    { id: 0, name: 'Semua' },
    { id: 1, name: 'Faskes', count: props.favorites?.facility.length || 0 },
    { id: 2, name: 'Layanan', count: props.favorites?.service.length || 0 },
    { id: 3, name: 'Obatan', count: props.favorites?.drug.length || 0 },
]

</script>