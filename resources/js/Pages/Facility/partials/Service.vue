<template>
    <main>
        <!-- copywriter -->
        <h1 class="text-2xl text-green-800 mb-2">Selamat Datang</h1>
        <p class="mb-6 text-gray-800">Di halaman kami yang menampilkan berbagai layanan kesehatan yang tersedia di faskes
            kami. Kami
            menyediakan
            berbagai jenis layanan kesehatan untuk memenuhi kebutuhan Anda dan keluarga.</p>
        <!-- searching -->
        <SearchBar></SearchBar>

        <!-- cards -->
        <section class="w-full columns-2">
            <template v-for="service in props?.services" :key="service?.id">
                <ServiceCard :data="service" class="break-inside-avoid"></ServiceCard>
            </template>
        </section>
    </main>
</template>

<script setup>

import SearchBar from '@/Pages/Facility/partials/SearchBar.vue'
import ServiceCard from '@/Components/card/ServiceDrugCard.vue'

const props = defineProps({
    services: Array
})

</script>