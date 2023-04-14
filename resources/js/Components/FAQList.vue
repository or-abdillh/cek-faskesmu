<template>
    <section class="text-gray-800">
        <button class="mb-2 text-lg font-semibold text-left" @click="isShow = !isShow">
            <i class="fa-solid mr-2" :class="isShow ? 'fa-chevron-down' : 'fa-chevron-up'"></i>
            {{ props.faq?.question }}
        </button>
        <Transition enter-active-class="duration-300">
            <section class="flex items-center justify-between gap-4 md:gap-0" v-if="isShow">
                <p class="inline-block w-[95%] bg-gray-100 border border-gray-200 p-6 rounded-lg">
                    {{ props.faq?.answer }}</p>
                <button @click="isLike = !isLike"><i :class="isLike ? 'fa-solid' : 'fa-regular'"
                        class="fa-thumbs-up"></i></button>
            </section>
        </Transition>
    </section>
</template>

<script setup>

import { ref } from 'vue'

const isShow = ref(false)
const isLike = ref(false)

const props = defineProps({
    faq: {
        type: Object,
        default: {
            question: 'Adipisicing culpa proident eiusmod ea deserunt exercitation in tempor pariatur aute.',
            answer: 'Voluptate qui id aute excepteur fugiat proident incididunt Lorem enim laborum ex nulla. Exercitation labore amet in cillum culpa dolor id ad consectetur sit adipisicing laborum sint. Ea non aute irure amet est dolore aliqua dolore ad culpa elit. Aute voluptate laboris qui incididunt laboris irure tempor consectetur enim consequat anim elit excepteur enim. Id commodo id voluptate id eiusmod officia pariatur exercitation deserunt veniam pariatur eu. Elit eu cupidatat amet pariatur aute qui nostrud sunt id anim veniam.'
        }
    }
})

</script>