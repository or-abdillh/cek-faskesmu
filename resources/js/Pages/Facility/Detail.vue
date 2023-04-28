<template>
    <BaseLayout>
        <!-- header -->
        <header class="bg-green-800 md:px-12 p-8 md:py-16 mt-28">
            <BreadCrumb class="text-gray-300"></BreadCrumb>
            <section class="flex flex-col md:flex-row justify-between items-center gap-4 md:gap-0">
                <!-- Profile -->
                <section class="md:w-8/12 text-gray-300">
                    <h1 class="text-3xl md:text-4xl font-semibold text-gray-200 mb-3">{{ props.facility?.name }}</h1>
                    <p class="mb-6">{{ props.facility?.address }}</p>
                    <h2 class="text-md font-semibold">Tentang faskses ini</h2>
                    <p>{{ props.facility?.description }}</p>
                </section>
                <!-- actions -->
                <section v-if="$page.props.auth?.user?.roles[0].name === 'user'"
                    class="w-full md:w-3/12 flex md:flex-col gap-3 text-gray-200 md:text-right">
                    <span><i class="fa-solid fa-star mr-2"></i>{{ props?.rateAverage }}</span>
                    <p class="cursor-pointer" @click="showModal = !showModal"><i class="fa-solid fa-edit mr-2"></i>Beri
                        ulasan</p>
                </section>
            </section>

        </header>
        <!-- contents -->
        <main class=" md:px-12 p-8 md:py-16">
            <!-- tabs -->
            <section class="flex items-center gap-2 md:gap-8 text-lg mb-8 sticky top-24 md:top-28 bg-gray-100 py-4 z-20">
                <template v-for="tab in tabs" key="tab.id">
                    <button @click="tabActive = tab.name"
                        :class="tabActive === tab.name ? 'border-green-800 text-green-800' : 'text-gray-500 border-gray-100'"
                        class="relative duration-300 border-b-2 px-1 pb-2">
                        {{ tab.name }}
                        <span v-if="tab.stat"
                            class="absolute -top-2 -right-2 md:-right-4 h-5 w-5 text-xs bg-green-600 text-gray-200 rounded-full grid place-items-center">{{
                                tab?.stat
                            }}</span>
                    </button>
                </template>
            </section>
            <section class="flex flex-col md:flex-row justify-between">
                <!-- tab view -->
                <section class="md:w-8/12">
                    <!-- Layanan -->
                    <Service v-if="tabActive === 'Layanan'" :services="props?.services"></Service>
                    <!-- Obatan -->
                    <Drugs v-if="tabActive === 'Obatan'" :drugs="props?.drugs"></Drugs>
                    <!-- Lokasi -->
                    <Location v-if="tabActive === 'Lokasi'" :lat="props.facility?.latitude"
                        :lng="props.facility?.longitude"></Location>
                    <!-- Ulasan -->
                    <Review :reviews="props?.reviews" :average="props?.rateAverage" :facility-name="props?.facility?.name"
                        v-if="tabActive === 'Ulasan'"></Review>
                </section>
                <!-- image -->
                <section>
                    <img class="rounded-lg"
                        src="https://cdn0-production-assets-kly.akamaized.net/medias/1411942/small-portrait/059095200_1479717151-24.jpg"
                        alt="Faskes">
                    <!-- contacts -->
                    <section class="flex flex-col gap-2 mt-4">
                        <!-- phone -->
                        <div class="bg-gray-200 rounded p-3 text-gray-700 flex justify-between items-center">
                            <i class="fa-brands fa-whatsapp"></i>
                            {{ props.facility?.phone_number }}
                        </div>
                        <!-- provider -->
                        <div class="bg-gray-200 rounded p-3 text-gray-700 flex justify-between items-center">
                            <i class="fa-solid fa-user"></i>
                            {{ props.provider?.name }}
                        </div>
                    </section>
                </section>
            </section>
        </main>
    </BaseLayout>

    <!-- modal -->
    <Modal :show="showModal" max-width="md">
        <UserReview :item="props?.facility" type="App\Models\Facility" @modal:close="showModal = false"></UserReview>
    </Modal>
</template>

<script setup>

import { ref, onMounted } from 'vue'
import Modal from '@/Components/Modal.vue'
import UserReview from '@/Components/form/UserReview.vue'
import BaseLayout from '@/Layouts/BaseLayout.vue'
import BreadCrumb from '@/Components/base/BreadCrumb.vue'
import Service from '@/Pages/Facility/partials/Service.vue'
import Drugs from '@/Pages/Facility/partials/Drugs.vue'
import Location from '@/Pages/Facility/partials/Location.vue'
import Review from '@/Pages/Facility/partials/Review.vue'

const props = defineProps({
    facility: Object,
    services: Array,
    drugs: Array,
    provider: Object,
    reviews: Array,
    rateAverage: Number
})

const tabActive = ref('Layanan')
const showModal = ref(false)

const tabs = [
    { id: 0, name: 'Layanan', stat: props?.services?.length || 0 },
    { id: 1, name: 'Obatan', stat: props?.drugs?.length || 0 },
    { id: 3, name: 'Ulasan' },
    { id: 2, name: 'Lokasi' },
]

onMounted(() => {
    // Get param key and type
    const queryParams = new URLSearchParams(window.location.search)
    const type = queryParams.get('type') || ''

    if (type.length > 0) {
        switch (type.toLowerCase()) {
            case 'service': tabActive.value = 'Layanan'
                break
            case 'drug': tabActive.value = 'Obatan'
        }
    }
})

</script>