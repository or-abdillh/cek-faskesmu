<template>
    <BaseLayout>
        <!-- Hero Section -->
        <Container
            class="flex flex-col-reverse justify-center relative min-h-[105vh] bg-cover bg-no-repeat bg-center bg-[url('https://images.unsplash.com/photo-1576091160550-2173dba999ef?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80')]">
            <!-- layer -->
            <section class="absolute inset-0 bg-gray-900 bg-opacity-70"></section>
            <!-- copywriter -->
            <section class="z-20 md:w-9/12 translate-y-10">
                <h1 class="text-3xl md:text-5xl font-semibold text-gray-100 mb-5 md:mb-8">
                    Mudah akses informasi kesehatan <br> dengan <strong
                        class="underline underline-offset-4">CekFaskesmu</strong>
                </h1>
                <p class="text-xl text-gray-200 mb-6">
                    Platform kami menawarkan beragam fitur untuk membantu Anda menghemat uang dan membuat keputusan yang
                    tepat terkait kesehatan Anda. Mulai dari membandingkan harga obat dan layanan, hingga menemukan
                    penyedia layanan kesehatan terbaik di dekat Anda, kami siap membantu.</p>
                <Link href="/register" class="inline-block bg-green-700 text-gray-50 px-6 py-3 rounded-full">Bergabung
                sekarang</Link>
            </section>
        </Container>

        <!-- Stats -->
        <section class="bg-green-800">
            <Container class="flex justify-around rounded-t-2xl -translate-y-5 bg-green-800">
                <template v-for="stat in stats" :key="stat.title">
                    <span class="text-center text-gray-200">
                        <h1 class="text-4xl font-semibold">{{ stat.count }}</h1>
                        <p>{{ stat.title }}</p>
                    </span>
                </template>
            </Container>
        </section>

        <!-- Services -->
        <section class="bg-gray-50">
            <Container class="md:py-20 rounded-t-2xl -translate-y-5 bg-gray-50 flex justify-between gap-4">
                <!-- copywriter -->
                <section class="md:w-6/12 text-gray-800">
                    <h1 class="text-5xl font-semibold mb-6">Apa yang pengguna dapatkan</h1>
                    <p class="mb-8">
                        Dari membandingkan harga obat-obatan dan layanan kesehatan, hingga menemukan
                        fasilitas kesehatan
                        terbaik di sekitar Anda,
                    </p>
                    <span class="uppercase">
                        <i class="fa-solid fa-arrow-right-long"></i> Bergabung unutuk mendapatkan fitur lainnya
                    </span>
                </section>
                <!-- contents -->
                <section class="md:w-6/12 flex flex-col gap-8">
                    <template v-for="service in services" :key="service.title">
                        <section>
                            <span class="text-gray-800 flex items-center gap-3 text-2xl mb-3">
                                <i :class="service.icon"></i>
                                <h2 class="font-semibold">{{ service.title }}</h2>
                            </span>
                            <p>{{ service.sub }}</p>
                        </section>
                    </template>
                </section>
            </Container>
        </section>

        <!-- Faskes Finder -->
        <section class="bg-green-800">
            <Container class="rounded-t-2xl -translate-y-5 bg-green-800 flex-col items-center text-center">
                <!-- copywriter -->
                <h1 class="text-gray-100 text-4xl font-semibold mb-4">Temukan Faskes Terdekat dengan Mudah</h1>
                <p class="text-gray-200 mb-4">
                    Dapatkan kemudahan dalam mencari faskes terdekat dengan fitur pencarian kami yang cepat dan
                    efektif
                </p>
                <!-- searchbar -->
                <section class="md:w-8/12 mx-auto">
                    <Text></Text>
                </section>
            </Container>
        </section>
    </BaseLayout>
</template>

<script setup>

import { Link } from '@inertiajs/vue3'
import BaseLayout from '@/Layouts/BaseLayout.vue'
import Container from '@/Components/base/Container.vue'
import Text from '@/Components/form/Text.vue'

const stats = [
    { title: 'Lokasi', count: '100' },
    { title: 'Pengguna', count: '10.000' },
    { title: 'Faskes Terdaftar', count: '5.000' },
    { title: 'Layanan Kesehatan', count: '15.000' },
    { title: 'Obat Tersedia', count: '50.000' },
]

const services = [
    { title: 'Faskes Terdekat', icon: 'fa-solid fa-truck-medical', sub: 'Memungkinkan pengguna untuk mencari faskes terdekat berdasarkan lokasi, sehingga dapat dengan mudah menemukan layanan kesehatan yang dibutuhkan.' },
    { title: 'Info Faskes', icon: 'fa-solid fa-hospital', sub: 'Menyediakan informasi biaya dari berbagai fasilitas kesehatan di Indonesia, sehingga pengguna dapat membandingkan dan memilih yang paling sesuai dengan kebutuhan dan anggaran.' },
    { title: 'Ulasan', icon: 'fa-solid fa-people-group', sub: 'Pengguna dapat memberikan ulasan dan rating tentang layanan kesehatan yang telah mereka gunakan, sehingga dapat membantu pengguna lain dalam memilih faskes yang tepat.' },
]

</script>