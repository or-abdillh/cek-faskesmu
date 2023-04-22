<template>
    <BaseLayoutCard class="mb-4">
        <!-- thumbnail -->
        <section
            class="w-full flex py-4 justify-end pr-4 rounded-xl shadow h-44 bg-top bg-cover bg-[url('https://images.unsplash.com/photo-1551076805-e1869033e561?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTR8fGRvY3RvcnxlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60')]">
            <button v-if="$page.props.auth" title="Simpan" @click="isBookmarked = !isBookmarked"
                class="w-10 h-10 hover:bg-opacity-75 active:scale-105 duration-300 grid place-items-center rounded-full bg-gray-400 bg-opacity-50 backdrop-blur text-gray-200 border border-gray-300 z-10"><i
                    :class="isBookmarked ? 'fa-solid' : 'fa-regular'" class="fa-bookmark"></i></button>
        </section>
        <!-- contents -->
        <section class="py-4">
            <h1 class="text-gray-700 text-lg font-semibold mt-1 mb-3">{{ props.data?.name }}</h1>
            <!-- description -->
            <section :class="{ 'h-16': !isViewMore }" class="overflow-hidden mb-4 duration-300">
                <h3 class="text-gray-600 text-sm mb-1">
                    Deskripsi
                </h3>
                <p class="text-gray-700 text-md mb-2">{{ props.data?.description }}</p>
                <section class="w-full text-sm text-gray-500 flex gap-4 mb-4">
                    <!-- rate -->
                    <span>
                        <i class="fa-solid fa-star"></i>
                        4.5
                    </span>
                    <!-- reviews -->
                    <span>
                        <i class="fa-solid fa-user-group"></i>
                        12
                    </span>
                </section>
                <!-- other cta -->
                <section class="text-sm text-blue-700">
                    <button @click="seeReview">Lihat ulasan</button>
                </section>
            </section>
            <!-- view more -->
            <button @click="isViewMore = !isViewMore"
                class="w-full duration-300 bg-gray-100 text-gray-700 rounded py-2 text-sm mb-4"
                :title="isViewMore ? 'Tampilkan sedikit data' : 'Tampilkan lebih banyak'">
                {{ isViewMore ? 'Tampilkan sedikit data' : 'Tampilkan lebih banyak' }}</button>
            <!-- price -->
            <section class="text-gray-700 text-right mb-4">
                <small>Biaya</small>
                <h2 class="text-xl font-semibold">
                    Rp{{ props.data?.price.toLocaleString() }}/{{ props.data?.unit_type }}
                </h2>
            </section>
            <!-- cta -->
            <section>
                <Link class="block px-4 py-2 bg-green-800 text-center rounded-xl text-lg text-gray-100"
                    :href="props.facility?.URL">Bandingkan Harga
                </Link>
            </section>
        </section>
    </BaseLayoutCard>
</template>

<script setup>

import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'
import BaseLayoutCard from '@/Components/card/BaseLayoutCard.vue'

const props = defineProps({
    data: Object
})

const emits = defineEmits(['card:open-review-page'])

const isBookmarked = ref(false)
const isViewMore = ref(false)

const seeReview = id => emits('card:open-review-page')

</script>