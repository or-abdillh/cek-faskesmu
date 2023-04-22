<template>
    <nav ref="navbar" class="fixed bg-gray-100 top-0 left-0 right-0 py-8 px-8 md:px-12 duration-300 z-40"
        :class="{ 'bg-opacity-0': isHomeRoute }">
        <section class="w-full flex justify-between items-center">
            <!-- logo -->
            <Logo></Logo>
            <!-- menus -->
            <section :class="showSideBar ? 'right-0' : '-right-full'"
                class="fixed md:static flex flex-col md:flex-row items-center gap-10 top-0 bottom-0 duration-300 text-right md:text-left p-8 md:p-0 bg-gray-50 md:bg-opacity-0 shadow md:shadow-none">
                <!-- links -->
                <section class="md:p-0 flex flex-col md:flex-row gap-5 md:gap-10 md:justify-between">
                    <!-- close sidebar -->
                    <button @click="showSideBar = !showSideBar" class="text-right md:hidden"><i
                            class="fa-solid fa-times"></i></button>
                    <template v-for="link in links" :key="link.path">
                        <Link :href="link.path"
                            :class="{ 'md:text-gray-600': !isHomeRoute, 'md:text-gray-600': isOverScrolled, 'md:text-gray-300': !isOverScrolled }"
                            class="uppercase text-xl font-bold inline-block text-gray-800">{{ link.title }}
                        </Link>
                    </template>
                </section>
                <!-- CTA -->
                <section class="flex flex-col md:flex-row items-end md:items-center gap-4">
                    <ProfileButton v-if="$page.props.auth.user"></ProfileButton>
                    <Link v-else class="bg-green-700 text-gray-50 px-6 py-3 rounded-full" href="/login">
                        Masuk
                    </Link>
                    <Link :href="route('logout')" method="post" as="button">Logout</Link>
                </section>
            </section>
            <!-- Collapse button -->
            <section class="md:hidden">
                <button @click="showSideBar = !showSideBar"><i :class="!isOverScrolled ? 'text-gray-300' : 'text-gray-800'"
                        class="text-2xl fa-solid fa-bars"></i></button>
            </section>
        </section>
    </nav>
</template>

<script setup>

import { ref, onMounted, computed } from 'vue'
import { Link, router } from '@inertiajs/vue3'
import Logo from '@/Components/base/Logo.vue'
import ProfileButton from '@/Components/base/ProfileButton.vue'

const navbar = ref(null)
const isHomeRoute = computed(() => router.page.url == '/')
const isOverScrolled = ref(!isHomeRoute.value)
const showSideBar = ref(false)

const links = [
    { path: '/', title: 'Beranda' },
    { path: '/facility', title: 'Fasilitas' },
    { path: '/', title: 'Layanan' },
    { path: '/', title: 'Obat' },
    { path: '/', title: 'Tentang Kami' },
]

onMounted(() => {

    window.addEventListener('scroll', () => {
        if (!isHomeRoute.value) isOverScrolled.value = true
        else {
            // Cek apakah posisi scroll melebihi tinggi navbar
            if (window.pageYOffset > navbar.value.offsetTop + 150) {
                // Jika melebihi, ubah warna navbar
                navbar.value.classList.replace('bg-opacity-0', 'bg-gray-50')
                isOverScrolled.value = true
            } else {
                // Jika tidak, kembalikan warna navbar ke semula
                navbar.value.classList.replace('bg-gray-50', 'bg-opacity-0')
                isOverScrolled.value = false
            }
        }
    })
})


</script>