<template>
    <BaseLayout>
        <section class="md:px-12 p-8 md:py-16 mt-20">
            <BreadCrumb class="text-gray-900"></BreadCrumb>
            <!-- main -->
            <main class="mt-12 flex flex-col justify-between">
                <!-- main item -->
                <section class="md:w-3/12">
                    <MainItemCard :data="props.item" :use-CTA="false" :use-review="false"></MainItemCard>
                </section>

                <!-- results -->
                <section class="md:w-8/12">
                    <h1 class="text-2xl text-gray-800 mb-2">Perbandingan</h1>
                    <p class="text-gray-700 mb-8">Menampilkan hasil perbandigan harga dari berbagai fasilitas kesehatan
                        lainnya
                        yang terdekat dan relevan dengan item pilihan anda</p>

                    <!-- list  -->
                    <section class="">
                        <template v-for="(compare, index) in props?.compares" :key="list">
                            <!-- card -->
                            <section
                                class="rounded-xl px-8 py-6 bg-gray-50 flex items-start gap-8 mb-4 border border-gray-200">
                                <!-- detail -->
                                <section class="w-full">
                                    <h1 class="text-gray-700 font-semibold text-xl mb-2">{{ compare.name }}</h1>
                                    <section
                                        class="w-full text-sm text-gray-500 flex gap-4 mb-4 border-b border-gray-200 pb-4">
                                        <!-- rate -->
                                        <span>
                                            <i class="fa-solid fa-star"></i>
                                            {{ compare.rate }}
                                        </span>
                                        <!-- reviews -->
                                        <span>
                                            <i class="fa-solid fa-user-group"></i>
                                            {{ compare.userHasRate }}
                                        </span>
                                        <!-- Facility name -->
                                        <span>
                                            <i class="fa-solid fa-house-medical"></i>
                                            {{ compare.facilityName }}
                                        </span>
                                        <!-- City -->
                                        <span>
                                            <i class="fa-solid fa-map"></i>
                                            {{ compare.location }}
                                        </span>
                                    </section>

                                    <!-- description -->
                                    <section class="mb-8">
                                        <h3 class="text-gray-600 text-sm mb-1">
                                            Deskripsi
                                        </h3>
                                        <p class="text-gray-700 text-md mb-2">{{ compare.description }}</p>
                                        <!-- price -->
                                        <section class="text-gray-700 mb-4">
                                            <small>Biaya</small>
                                            <h2 class="text-xl font-semibold">
                                                Rp {{ compare.price.toLocaleString() }} /{{ compare.unit_type }}
                                            </h2>
                                        </section>
                                    </section>
                                    <!-- CTA -->
                                    <Link :href="compare.facilityUrl"
                                        class="block w-full px-4 py-2 bg-green-800 text-center rounded-xl text-sm text-gray-100">
                                    Lihat
                                    Faskes</Link>
                                </section>
                            </section>
                        </template>
                    </section>
                </section>
            </main>
        </section>
    </BaseLayout>
</template>

<script setup>

import { Link } from '@inertiajs/vue3'
import BaseLayout from '@/Layouts/BaseLayout.vue'
import BreadCrumb from '@/Components/base/BreadCrumb.vue'
import MainItemCard from '@/Components/card/ServiceDrugCard.vue'

const props = defineProps({
    item: Object,
    compares: Array
})

</script>