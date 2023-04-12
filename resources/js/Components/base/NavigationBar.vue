<template>
    <nav ref="navbar" class="fixed bg-gray-100 top-0 left-0 right-0 py-8 px-8 md:px-12 duration-300 z-40 bg-opacity-0">
        <section class="w-full flex justify-between items-center">
            <!-- logo -->
            <Logo></Logo>
            <!-- menus -->
            <section :class="showSideBar ? 'right-0' : '-right-full'"
                class="fixed md:static flex items-center gap-10 top-0 bottom-0 duration-300 text-right md:text-left p-8 md:p-0 bg-gray-50 md:bg-opacity-0">
                <!-- links -->
                <section class="md:p-0 flex flex-col md:flex-row gap-5 md:gap-10 md:justify-between">
                    <!-- close sidebar -->
                    <button @click="showSideBar = !showSideBar" class="text-right md:hidden"><i
                            class="fa-solid fa-times"></i></button>
                    <template v-for="link in links" :key="link.path">
                        <Link :href="link.path" :class="{ 'md:text-gray-600': isOverScrolled }"
                            class="uppercase text-xl font-bold inline-block text-gray-200">{{ link.title }}</Link>
                    </template>
                </section>
                <!-- CTA -->
                <section class="flex items-center gap-4">
                    <DarkModeToggler></DarkModeToggler>
                    <Link class="bg-green-700 text-gray-50 px-6 py-3 rounded-full" href="/login">Masuk</Link>
                </section>
            </section>
            <!-- Collapse button -->
            <section class="md:hidden">
                <button @click="showSideBar = !showSideBar"><i class="text-gray-800 text-2xl fa-solid fa-bars"></i></button>
            </section>
        </section>
    </nav>
</template>

<script setup>

import { ref, onMounted } from 'vue'
import { Link } from '@inertiajs/vue3'
import Logo from '@/Components/base/Logo.vue'
import DarkModeToggler from '@/Components/base/DarkModeToggler.vue'

const navbar = ref(null)
const isOverScrolled = ref(false)
const showSideBar = ref(false)

const links = [
    { path: '/', title: 'Beranda' },
    { path: '/', title: 'Fasilitas' },
    { path: '/', title: 'Layanan' },
    { path: '/', title: 'Obat' },
    { path: '/', title: 'Tentang Kami' },
]

onMounted(() => {
    window.addEventListener('scroll', () => {
        // Cek apakah posisi scroll melebihi tinggi navbar
        if (window.pageYOffset > navbar.value.offsetTop + 150) {
            // Jika melebihi, ubah warna navbar
            navbar.value.classList.replace('bg-opacity-0', 'bg-gray-100')
            isOverScrolled.value = true
        } else {
            // Jika tidak, kembalikan warna navbar ke semula
            navbar.value.classList.replace('bg-gray-100', 'bg-opacity-0')
            isOverScrolled.value = false
        }
    })
})


</script>