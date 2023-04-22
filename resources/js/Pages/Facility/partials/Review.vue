<template>
    <main>
        <!-- rating -->
        <section class="flex gap-4 justify-between border-b border-gray-300 pb-8 mb-8">
            <!-- resume -->
            <section class="text-center">
                <h1 class="text-6xl font-semibold text-gray-800 mb-2">{{ props?.average }}</h1>
                <AverageRateGenerate :average="props?.average"></AverageRateGenerate>
                <small>({{ props?.reviews?.length }})</small>
            </section>
            <!-- detail -->
            <section class="w-7/12 md:w-10/12 flex flex-col gap-1">
                <template v-for="(average, index) in averageDetails" :key="average">
                    <!-- star -->
                    <section class="flex items-center gap-3 text-gray-700">
                        <div class="flex items-center gap-1">{{ index + 1 }} <i class="fa-solid fa-star text-yellow-400"></i></div>
                        <div class="w-full h-2 bg-gray-200 rounded overflow-hidden">
                            <div :style="`width: ${ average }`" class="h-2 bg-yellow-400"></div>
                        </div>
                    </section>
                </template>
            </section>
        </section>

        <p class="text-gray-700 mb-8">Menampilkan {{ props?.reviews?.length }} ulasan tentang {{ props?.facilityName }}</p>
        
        <!-- cards -->
        <section class="flex justify-between flex-wrap gap-4">
            <template v-for="review in props.reviews?.reverse()" :key="review.id">
                <ReviewCard class="md:w-[47%]" :review="review"></ReviewCard>
            </template>
        </section>
    </main>
</template>

<script setup>

import { ref } from 'vue'
import ReviewCard from '@/Components/card/ReviewCard.vue'
import AverageRateGenerate from '@/Components/base/AverageRateGenerate.vue'

const props = defineProps({
    reviews: Array,
    facilityName: String,
    average: Number
})

const averageDetails = ref([])

for ( let rate = 1; rate <= 5; rate++ ) {
    averageDetails.value.push(
        ( props?.reviews.filter(review => review.rate === rate).length / props?.reviews.length ) * 100 + '%'
    )
}

</script>