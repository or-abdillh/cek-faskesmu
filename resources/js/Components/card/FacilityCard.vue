<template>
    <BaseLayoutCard>
        <!-- thumbnail -->
        <section
            class="w-full flex py-4 justify-end pr-4 rounded-xl shadow h-44 bg-top bg-cover bg-[url('https://cdn0-production-assets-kly.akamaized.net/medias/1411942/small-portrait/059095200_1479717151-24.jpg')]">
            <button v-if="props.isLogin" title="Simpan" @click="isBookmarked = !isBookmarked"
                class="w-10 h-10 hover:bg-opacity-75 active:scale-105 duration-300 grid place-items-center rounded-full bg-gray-100 bg-opacity-50 backdrop-blur text-gray-200"><i
                    :class="isBookmarked ? 'fa-solid' : 'fa-regular'" class="fa-bookmark"></i></button>
        </section>
        <!-- copywriter -->
        <section class="py-4">
            <!-- location -->
            <span class="text-gray-600 text-sm">
                {{ props.facility?.location }}
            </span>
            <!-- name -->
            <h1 class="text-gray-700 text-lg font-semibold mt-1 mb-3">{{ props.facility?.name }}</h1>
            <!-- information -->
            <section class="w-full text-sm text-gray-500 flex gap-4 mb-6">
                <!-- category -->
                <span>
                    <i class="fa-solid fa-house-medical"></i>
                    {{ props.facility?.category }}
                </span>
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
            <!-- CTA -->
            <Link class="block px-4 py-2 bg-green-800 text-center rounded-xl text-lg text-gray-100"
                :href="props.facility?.URL">Kunjungi
            </Link>
        </section>
    </BaseLayoutCard>
</template>

<script setup>

import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'
import BaseLayoutCard from '@/Components/card/BaseLayoutCard.vue'

const isBookmarked = ref(false)
const props = defineProps({
    facility: Object,
    isLogin: {
        type: Boolean,
        default: false
    }
})

</script>