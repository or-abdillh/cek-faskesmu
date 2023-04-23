<template>
    <main>
        <!-- header -->
        <section class="mb-10 border-b border-gray-300 pb-4 flex justify-between">
            <button class="text-gray-700" @click="emits('review-page:close')"><i class="fa-solid fa-arrow-left mr-2"></i>{{
                props.item }}</button>

            <button class="text-blue-700" @click="emits('review-page:show-modal')">Beri ulasan</button>

        </section>

        <p class="text-gray-700 mb-8">Menampilkan {{ props?.reviews?.length }} ulasan tentang {{ props?.item }}</p>

        <!-- cards -->
        <section class="columns-1 md:columns-2 gap-2">
            <template v-for="review in props.reviews" :key="review.id">
                <ReviewCard class="break-inside-avoid mb-4 w-11/12" :review="review"></ReviewCard>
            </template>
        </section>
    </main>
</template>

<script setup>

import ReviewCard from '@/Components/card/ReviewCard.vue'

const emits = defineEmits(['review-page:close', 'review-page:show-modal'])

const props = defineProps({
    item: String,
    reviews: Array
})

</script>