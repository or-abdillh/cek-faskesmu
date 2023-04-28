<template>
    <main>
        <section class="bg-gray-200 p-4 mb-4 text-gray-700 rounded-lg">
            <p>Lokasi anda saat ini berada pada <strong ref="locationEl">...</strong></p>
            <small>Pastikan anda telah memberikan akses lokasi kepada website ini, Gunakan perangkat mobile untuk mendapatkan keakuratan lebih tinggi</small>
        </section>

        <section id="map" class="z-10 h-[60vh]"></section>
    </main>
</template>

<script setup>

import { onMounted, ref } from 'vue'

const props = defineProps({
    lat: Number,
    lng: Number
})

const locationEl = ref(null)

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
    L.circleMarker([props.lat, props.lng], {
        radius: 5,
        color: 'red',
        fillColor: 'red',
        fillOpacity: 1
    }).addTo(map)

    
    
    // get current location
    if ( 'geolocation' in navigator ) {
        navigator.geolocation.getCurrentPosition(post => {
            const lat = post.coords.latitude
            const lng = post.coords.longitude

            // Get current name location
            const geocodeURL = 'https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=' + lat + '&lon=' + lng

            fetch(geocodeURL)
                .then(response => response.json())
                .then(data => {
                    const locationName = `${ data.address?.road }, ${ data.address?.village }, ${ data.address?.city }, ${ data.address?.state }`
                    locationEl.value.innerText = locationName || 'Data lokasi tidak valid'
                })

            // Create Routing
            const control = L.Routing.control({
                waypoints: [
                    L.latLng(lat, lng),
                    L.latLng(props.lat, props.lng)
                ],
                routeWhileDragging: true,
                router: L.Routing.osrmv1({
                    serviceUrl: 'http://router.project-osrm.org/route/v1',
                    profile: 'car',
                    useHints: false
                })
            }).addTo(map)
        }, 
        err => console.error(err), { timeout: 15000 })
    }
    else locationEl.value.innerText = 'Akses Geolocation ditolak'
})

</script>