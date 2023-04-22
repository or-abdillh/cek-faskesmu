<template>
    <main>
        <!-- copywriter -->
        <h1 class="text-green-800 text-2xl mb-2">Selamat Datang</h1>
        <p class="text-gray-800 mb-6">
            Temukan obatan yang Anda butuhkan di faskes kami. Kami menyediakan berbagai jenis obat seperti kapsul, kaplet,
            tablet, botol, suntikan, dan biji dengan harga yang terjangkau. </p>
        <!-- searching -->
        <SearchBar></SearchBar>

        <!-- cards -->
        <section class="w-full md:columns-2">
            <template v-for="drug in props?.drugs" :key="drug?.id">
                <DrugCard class="break-inside-avoid" :data="drug"></DrugCard>
            </template>
        </section>
    </main>
</template>

<script setup>

import SearchBar from '@/Pages/Facility/partials/SearchBar.vue'
import DrugCard from '@/Components/card/ServiceDrugCard.vue'

const props = defineProps({
    drugs: Array
})

</script>