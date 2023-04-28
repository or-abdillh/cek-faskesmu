<template>
    <button id="button" @click="clicked"
        class="fixed right-5 bottom-28 rounded-full bg-gray-100 bg-opacity-50 backdrop-blur w-12 h-12 border-2 border-gray-300 text-gray-800 opacity-0 duration-300"
        title="Go To Top"><i class="fa-solid fa-arrow-up-long"></i></button>
</template>

<script setup>

import { onMounted, ref } from 'vue'


const clicked = () => {
    document.querySelector('#app').scrollIntoView({
        behavior: 'smooth',
    })
}

onMounted(() => {
    const button = document.querySelector('#button')

    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            button.classList.replace('opacity-0', 'opacity-1')
        } else {
            button.classList.replace('opacity-1', 'opacity-0')
        }
    })
})

</script>