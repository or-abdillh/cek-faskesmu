<template>
    <BaseLayout>
        <!-- faskes finder -->
        <section class="relative w-full bg-green-800 md:px-12 p-8 md:py-16 mt-28">
            <!-- searchbar -->
            <section
                class="md:absolute md:-bottom-[30%] md:translate-x-[20%] w-full md:w-8/12 bg-gray-100 border border-gray-300 shadow rounded-xl overflow-hidden flex flex-col md:flex-row justify-around  px-2 md:pr-6 py-3">
                <!-- keyword -->
                <section class="pl-6 w-7/12 md:border-r border-gray-400 flex items-center">
                    <i class="fa-solid fa-search text-gray-700"></i>
                    <input v-model="search.keyword" class="w-full p-4 bg-gray-100 outline-none" type="search"
                        placeholder="Nama faskes" list="facilities">
                    <!-- datalist -->
                    <datalist id="facilities">
                        <template v-for="facility in props.facilities" :key="facility.id">
                            <option :value="facility.name"></option>
                        </template>
                    </datalist>
                </section>
                <section class="flex md:w-5/12 mb-4 md:mb-0">
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
                <PrimaryButton @click="filtering">Cari</PrimaryButton>
            </section>
        </section>

        <!-- search results -->
        <section class="md:p-16 p-8">
            <section class="flex justify-between gap-6 mb-6">
                <p class="text-gray-600 text-lg" ref="searchDetail">Hasil pencarian untuk </p>
                <p class="text-gray-600">Menampilkan {{ filteredFacilities.length }} fasilitas</p>
            </section>

            <!-- wrapper -->
            <section class="w-full flex-col-reverse md:flex-row gap-6 md:gap-0 flex justify-between">
                <!-- cards -->
                <section class="md:w-7/12 md:columns-2">
                    <template v-for="facility in filteredFacilities" :key="facility.id">
                        <FacilityCard :facility="facility" class="mb-4 break-inside-avoid"></FacilityCard>
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
import PrimaryButton from '@/Components/PrimaryButton.vue'

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

const searchDetail = ref(null)

const filteredFacilities = ref(props.facilities)

const filtering = () => {
    filteredFacilities.value = props.facilities.filter(facility => {
        if (facility.name.toLowerCase().includes(search.keyword.toLowerCase())) {
            // Category and Location
            if (search.category === 'all' && search.location === 'all') return facility
            else {
                if (search.category === 'all') {
                    if (facility.location === search.location) return facility
                } else if (search.location === 'all') {
                    if (facility.category === search.category) return facility
                } else {
                    if (facility.location === search.location && facility.category === search.category) return facility
                }
            }
        }

        if (search.keyword.length > 0) {
            searchDetail.value.innerHTML = `Hasil pencarian untuk <strong class="text-gray-900">"${search.keyword}"</strong>`
        } else {
            searchDetail.value.innerHTML = `Hasil pencarian untuk <strong class="text-gray-900">"Semua"</strong>`
        }
    })
}

onMounted(() => {

    // Leaflet Init
    const map = L.map('map').setView([props.centerMap?.lat, props.centerMap?.lng], 8)

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