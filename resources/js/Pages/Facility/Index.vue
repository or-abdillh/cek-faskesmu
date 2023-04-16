<template>
    <BaseLayout>
        <!-- faskes finder -->
        <section class="relative w-full bg-green-800 md:px-12 p-8 md:py-16 mt-28">
            <!-- searchbar -->
            <section
                class="md:absolute md:-bottom-[30%] md:translate-x-[20%] w-full md:w-8/12 bg-gray-100 border border-gray-300 shadow rounded-xl overflow-hidden flex flex-col md:flex-row justify-around pr-6 py-3">
                <!-- keyword -->
                <section class="pl-6 w-8/12 md:border-r border-gray-400 flex items-center">
                    <i class="fa-solid fa-search text-gray-700"></i>
                    <input class="w-full p-4 bg-gray-100 outline-none" type="search" placeholder="Nama faskes">
                </section>
                <section class="flex md:w-4/12">
                    <!-- category -->
                    <section class="flex flex-col pl-6 justify-center">
                        <label for="category" class="text-gray-700 text-xs">Kategori</label>
                        <select class="bg-gray-100" id="category" name="category">
                            <option value="Rumah Sakit">Rumah Sakit</option>
                            <option value="Apotek">Apotek</option>
                            <option value="Klinik">Klinik</option>
                            <option value="Praktek">Praktek</option>
                            <option value="all">Semua</option>
                        </select>
                    </section>

                    <!-- location -->
                    <section class="flex flex-col pl-6 justify-center">
                        <label for="location" class="text-gray-700 text-xs">Lokasi</label>
                        <select class="bg-gray-100" id="location" name="location">
                            <option value="banjarbaru">Banjarbaru</option>
                            <option value="banjarmasin">Banjarmasin</option>
                            <option value="marabahan">Marabahan</option>
                            <option value="balangan">Balangan</option>
                            <option value="all">Semua</option>
                        </select>
                    </section>
                </section>
            </section>
        </section>

        <!-- search results -->
        <section class="md:p-16 p-8">
            <section class="flex justify-between gap-6 mb-6">
                <p class="text-gray-600 text-lg">Hasil pencarian <strong class="text-gray-900">"Keyword"</strong></p>
                <p class="text-gray-600">Menampilkan 23 fasilitas</p>
            </section>

            <!-- wrapper -->
            <section class="w-full flex-col-reverse md:flex-row gap-6 md:gap-0 flex justify-between">
                <!-- cards -->
                <section class="md:w-7/12 flex flex-wrap gap-3 justify-between">
                    <template v-for="card in 8" :key="card">
                        <FacilityCard class="md:w-[48%]"></FacilityCard>
                    </template>
                </section>
                <!-- map -->
                <section class="md:w-4/12 h-[50vh] md:h-[80vh] z-10" id="map"></section>
            </section>
        </section>
    </BaseLayout>
</template>

<script setup>

import { onMounted } from 'vue'
import BaseLayout from '@/Layouts/BaseLayout.vue'
import FacilityCard from '@/Components/card/FacilityCard.vue'

onMounted(() => {

    // Leaflet Init
    const map = L.map('map').setView([51.505, -0.09], 13)

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
})

</script>