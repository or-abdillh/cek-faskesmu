<template>
    <section class="p-6">
        <!-- header -->
        <section class="text-gray-700 flex justify-between mb-8">
            <button @click="close"><i class="fa-solid fa-times"></i></button>
            <h1 class="text-xl">Map Picker</h1>
            <span></span>
        </section>

        <!-- main -->
        <main>
            <section id="map-picker" class="h-[70vh] mb-4"></section>
            <button @click="save" class="bg-green-500 w-full py-2 rounded-md text-gray-200">Simpan Koordinat</button>
        </main>
    </section>
</template>

<script setup>

import { onMounted, ref } from 'vue'

const emits = defineEmits(['modal:close', 'map:picker'])

const close = () => {
    setTimeout(() => {
        emits('modal:close')
    }, 200);
}

const props = defineProps({
    lng: Number,
    lat: Number
})

const longitude = ref(props?.lng || null)
const latitude = ref(props?.lat || null)

const save = () => {
    emits('map:picker', { longitude: longitude.value, latitude: latitude.value })
    emits('modal:close')
}

onMounted(() => {
    // init map
    const map = L.map('map-picker').setView([props?.lat, props?.lng], 6)

    // Add the Tile layer to the map
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
    }).addTo(map)

    // Add a marker with a popup to the map
    const marker = L.marker([props?.lat, props?.lng]).addTo(map)

    // Update the marker position when the map is clicked
    const onMapClick = e => {
        marker.setLatLng(e.latlng)
        updateLatLngInputs(e.latlng)
    }

    map.on('click', onMapClick)

    const updateLatLngInputs = latlng => {
        longitude.value = latlng.lng.toFixed(6)
        latitude.value = latlng.lat.toFixed(6)
    }
})

</script>