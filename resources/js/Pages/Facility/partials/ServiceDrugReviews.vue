<template>
    <main>
        <!-- header -->
        <section class="mb-10 border-b border-gray-300 pb-4 flex justify-between">
            <button class="text-gray-700" @click="emits('review-page:close')"><i class="fa-solid fa-arrow-left mr-2"></i>{{
                props.item }}</button>

            <button class="text-blue-700" @click="emits('review-page:show-modal')">Beri ulasan</button>

        </section>

        <p class="text-gray-700 mb-8">Menampilkan {{ props?.reviews?.length }} ulasan tentang {{ props?.item }}</p>

        <!-- rate filter -->
        <RatePickerButtons @rate-picker:pick="filtering" @rate-picker:reset="filteredItems = props.reviews">
        </RatePickerButtons>

        <!-- cards -->
        <section class="columns-1 md:columns-2 gap-2">
            <template v-for="review in filteredItems" :key="review.id">
                <ReviewCard class="break-inside-avoid mb-4 w-11/12" :review="review"></ReviewCard>
            </template>
        </section>
    </main>
</template>

<script setup>

import { ref } from 'vue'
import ReviewCard from '@/Components/card/ReviewCard.vue'
import RatePickerButtons from '@/Components/base/RatePickerButtons.vue'

const emits = defineEmits(['review-page:close', 'review-page:show-modal'])

const props = defineProps({
    item: String,
    reviews: Array
})

const filteredItems = ref(props.reviews)

const filtering = rate => filteredItems.value = props.reviews?.filter(review => review?.rate === rate)


</script>