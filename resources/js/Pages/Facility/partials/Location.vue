<template>
    <main>
        <section id="map" class="z-10 md:h-[80vh]"></section>
    </main>
</template>

<script setup>

import { onMounted } from 'vue'

const props = defineProps({
    lat: Number,
    lng: Number
})

onMounted(() => {
    // Leaflet Init
    const map = L.map('map').setView([props.lat, props.lng], 6)

    // Add layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
    }).addTo(map)

    // add marker
    L.marker([props.lat, props.lng]).addTo(map)
})

</script>