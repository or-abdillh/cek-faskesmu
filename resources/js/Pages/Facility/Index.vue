<template>
    <BaseLayout>
        <!-- faskes finder -->
        <section class="relative w-full bg-green-800 md:px-12 p-8 md:py-16 mt-28">
            <!-- searchbar -->
            <section
                class="md:absolute md:-bottom-[30%] md:translate-x-[20%] w-full md:w-8/12 bg-gray-100 border border-gray-300 shadow rounded-xl overflow-hidden flex flex-col md:flex-row justify-around pr-6 py-3">
                <!-- keyword -->
                <section class="pl-6 w-7/12 md:border-r border-gray-400 flex items-center">
                    <i class="fa-solid fa-search text-gray-700"></i>
                    <input @input="filtering" v-model="search.keyword" class="w-full p-4 bg-gray-100 outline-none"
                        type="search" placeholder="Nama faskes">
                </section>
                <section class="flex md:w-5/12">
                    <!-- category -->
                    <section class="flex flex-col pl-6 justify-center">
                        <label for="category" class="text-gray-700 text-xs">Kategori</label>
                        <select v-model="search.category" class="bg-gray-100" id="category" name="category">
                            <option selected value="all">Semua</option>
                            <option value="Rumah Sakit">Rumah Sakit</option>
                            <option value="Apotek">Apotek</option>
                            <option value="Klinik">Klinik</option>
                            <option value="Praktek">Praktek</option>
                        </select>
                    </section>

                    <!-- location -->
                    <section class="flex flex-col pl-6 justify-center">
                        <label for="location" class="text-gray-700 text-xs">Lokasi</label>
                        <select v-model="search.location" class="bg-gray-100" id="location" name="location">
                            <option value="all">Semua</option>
                            <template v-for="location in props.locations" :key="location.city">
                                <option :value="location.city">{{ location.city }}</option>
                            </template>
                        </select>
                    </section>
                </section>
            </section>
        </section>

        <!-- search results -->
        <section class="md:p-16 p-8">
            <section class="flex justify-between gap-6 mb-6">
                <p class="text-gray-600 text-lg">Hasil pencarian <strong class="text-gray-900">"{{ search.keyword ?
                    search.keyword : 'Semua' }}"</strong></p>
                <p class="text-gray-600">Menampilkan {{ filteredFacilities.length }} fasilitas</p>
            </section>

            <!-- wrapper -->
            <section class="w-full flex-col-reverse md:flex-row gap-6 md:gap-0 flex justify-between">
                <!-- cards -->
                <section class="md:w-7/12 columns-2">
                    <template v-for="facility in filteredFacilities" :key="facility.id">
                        <FacilityCard :is-login="props.isLogin" :facility="facility" class="mb-4"></FacilityCard>
                    </template>
                </section>
                <!-- map -->
                <section class="md:w-4/12 h-[50vh] md:h-[80vh] z-10" id="map"></section>
            </section>
        </section>
    </BaseLayout>
</template>

<script setup>

import { onMounted, reactive, ref } from 'vue'
import BaseLayout from '@/Layouts/BaseLayout.vue'
import FacilityCard from '@/Components/card/FacilityCard.vue'

const props = defineProps({
    facilities: {
        type: Array,
        default: []
    },
    locations: Array,
    centerMap: Object,
    isLogin: {
        type: Boolean,
        default: false
    }
})

const search = reactive({
    keyword: '',
    category: 'all',
    location: 'all'
})

const filteredFacilities = ref(props.facilities)

const filtering = () => {
    filteredFacilities.value = props.facilities.filter(facility => {
        if (facility.name.toLowerCase().includes(search.keyword.toLowerCase())) return facility
    })
}

onMounted(() => {

    // Leaflet Init
    const map = L.map('map').setView([props.centerMap?.lat, props.centerMap?.lng], 6)

    // Add layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
    }).addTo(map);

    // Add multiple marker
    props.facilities.forEach(facility => {
        L.marker([facility.latitude, facility.longitude])
            .addTo(map)
            .bindPopup(`
                <b>${facility.name}</b>
                <br>
                <small>${facility.address}</small>
            `)
    })
})

</script>