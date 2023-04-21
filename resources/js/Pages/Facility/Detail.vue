<template>
    <BaseLayout>
        <!-- header -->
        <header class="bg-green-800 md:px-12 p-8 md:py-16 mt-28">
            <BreadCrumb></BreadCrumb>
            <section class="flex justify-between items-center">
                <!-- Profile -->
                <section class="md:w-8/12 text-gray-300">
                    <h1 class="text-3xl md:text-4xl font-semibold text-gray-200 mb-3">{{ props.facility?.name }}</h1>
                    <p class="mb-6">{{ props.facility?.address }}</p>
                    <h2 class="text-md font-semibold">Tentang faskses ini</h2>
                    <p>{{ props.facility?.description }}</p>
                </section>
                <!-- actions -->
                <section class="flex flex-col gap-3 text-gray-200">
                    <Link href="/"><i class="fa-solid fa-star mr-2"></i>Beri rating</Link>
                    <Link href="/"><i class="fa-solid fa-edit mr-2"></i>Beri ulasan</Link>
                </section>
            </section>

        </header>
        <!-- contents -->
        <main class=" md:px-12 p-8 md:py-16">
            <!-- tabs -->
            <section class="flex items-center gap-8 text-lg mb-8">
                <template v-for="tab in tabs" key="tab.id">
                    <button @click="tabActive = tab.id"
                        :class="tabActive === tab.id ? 'border-green-800 text-green-800' : 'text-gray-500 border-gray-100'"
                        class="duration-300 border-b-2 px-1">{{
                            tab.name
                        }}</button>
                </template>
            </section>
            <!-- tab view -->
            <section>
                <KeepAlive>
                    <component :is="tabs[tabActive].component"></component>
                </KeepAlive>
            </section>
        </main>
    </BaseLayout>
</template>

<script setup>

import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'
import BaseLayout from '@/Layouts/BaseLayout.vue'
import BreadCrumb from '@/Components/base/BreadCrumb.vue'
import Service from '@/Pages/Facility/partials/Service.vue'
import Drugs from '@/Pages/Facility/partials/Drugs.vue'
import Location from '@/Pages/Facility/partials/Location.vue'
import Review from '@/Pages/Facility/partials/Review.vue'

const props = defineProps({
    facility: Object
})

const tabActive = ref(0)

const tabs = [
    { id: 0, name: 'Layanan', component: Service },
    { id: 1, name: 'Obatan', component: Drugs },
    { id: 2, name: 'Lokasi', component: Location },
    { id: 3, name: 'Ulasan', component: Review }
]


</script>