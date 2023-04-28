<template>
    <section class="mb-12 flex gap-3 flex-wrap">
        <template v-for="star in 5" :key="star">
            <button @click="rated(star)"
                :class="rate === star ? 'bg-green-200 border-green-300' : 'bg-gray-50 border-gray-200'"
                class="text-gray-700 px-6 py-2 rounded-full border duration-300"><i
                    class="fa-solid fa-star text-yellow-500 mr-2"></i>{{
                        star
                    }}</button>
        </template>
    </section>
</template>

<script setup>

import { ref } from 'vue'

const rate = ref(0)
const emits = defineEmits(['rate-picker:pick', 'rate-picker:reset'])

const rated = star => {
    if (rate.value === star) {
        rate.value = 0
        emits('rate-picker:reset')
    } else {
        rate.value = star
        emits('rate-picker:pick', star)
    }
}

</script>