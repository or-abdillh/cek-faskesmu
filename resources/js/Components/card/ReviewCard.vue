<template>
    <main class="border-b border-gray-200 pb-4">
        <!-- header -->
        <section class="flex gap-4 mb-5">
            <!-- avatar -->
            <span><img class="rounded-full" width="50" :src="`https://ui-avatars.com/api/?background=228B22&color=fff&name=${ props?.review?.username }`"></span>
            <!-- stat and name -->
            <section>
                <p class="text-gray-800">{{ props?.review?.username }}</p>
                <small class="text-gray-600">{{ props?.review?.count }} ulasan faskes lain</small>
            </section>
        </section>
        <!-- body -->
        <section>
            <!-- rate and timestamp -->
            <section class="flex gap-2 mb-2">
                <StarRatingGenerate :rate="props?.review?.rate"></StarRatingGenerate>
                <small class="text-gray-700">{{ props?.review?.created_at }}</small>
            </section>
            <p class="text-gray-700">{{ props?.review?.content }}</p>
        </section>
    </main>
</template>

<script setup>

import StarRatingGenerate from '@/Components/base/StarRatingGenerate.vue'

const props = defineProps({
    review: Object
})

</script>