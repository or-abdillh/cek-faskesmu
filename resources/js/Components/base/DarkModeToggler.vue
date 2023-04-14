<template>
    <button @click="togglerHandler"
        class="text-green-700 dark:text-gray-200 h-12 w-12 rounded-full grid place-items-center bg-gray-100 dark:bg-slate-800">
        <i v-if="!isDarkToggle" class="fas fa-sun"></i>
        <i v-else class="fas fa-moon"></i>
    </button>
</template>

<script setup>

import { onMounted, ref } from 'vue'

const getLocalStorage = () => {
    return Boolean(parseInt(localStorage.getItem('cek-faskesmu:dark-mode')) | 0)
}

const isDarkToggle = ref(getLocalStorage())

const setLocalStroge = () => {
    localStorage.setItem('cek-faskesmu:dark-mode', Number(!isDarkToggle.value))
}

const htmlToggler = () => document.querySelector('html').classList.toggle('dark')

const togglerHandler = () => {
    setTimeout(() => {
        setLocalStroge()
        isDarkToggle.value = !isDarkToggle.value
        htmlToggler()
    }, 300)
}

onMounted(() => {
    console.log(getLocalStorage())
    if (getLocalStorage()) htmlToggler()
})

</script>