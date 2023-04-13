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
            <Container class="flex justify-around bg-green-800 -translate-y-11">
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
            <Container class="md:py-20 bg-gray-50 flex justify-between gap-4">
                <!-- copywriter -->
                <section class="md:w-6/12 text-gray-800">
                    <h1 class="text-5xl font-semibold mb-6">Apa Yang Pengguna Dapatkan</h1>
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
            <Container class="bg-green-800 flex-col items-center text-center">
                <!-- copywriter -->
                <h1 class="text-gray-100 text-4xl font-semibold mb-4">Temukan Faskes Terdekat dengan Mudah</h1>
                <p class="text-gray-200 mb-4">
                    Dapatkan kemudahan dalam mencari faskes terdekat dengan fitur pencarian kami yang cepat dan
                    efektif
                </p>
                <section class="md:w-8/12 mx-auto mb-12">
                    <!-- searchbar -->
                    <Text></Text>
                </section>
                <!-- results -->
                <section class="flex gap-6 justify-between mb-12">
                    <template v-for="result in 4" :key="result">
                        <section
                            class="rounded-2xl w-full overflow-hidden border border-gray-200 hover:scale-105 duration-300">
                            <!-- thumbnail -->
                            <section
                                class="relative w-full h-[24rem] bg-center bg-cover bg-[url('https://cdn0-production-assets-kly.akamaized.net/medias/1411942/small-portrait/059095200_1479717151-24.jpg')]">
                                <!-- layer -->
                                <section
                                    class="text-left flex flex-col justify-end absolute inset-0 bg-gradient-to-b from-transparent to-gray-950">
                                    <section class="text-gray-200 px-6 py-8">
                                        <h1 class="text-2xl">RS Mata Jombang</h1>
                                        <p class="text-sm">JL. Ahmad Yani KM 35 No 901 Pati Utara</p>
                                    </section>
                                </section>
                            </section>
                        </section>
                    </template>
                </section>
                <Link class="text-xl text-gray-100" href="/">
                <i class="fa-solid fa-arrow-right"></i>
                Temukan lebih banyak faskes
                </Link>
            </Container>
        </section>

        <!-- how it works -->
        <section class="bg-gray-50">
            <Container class="bg-gray-50">
                <h1 class="text-5xl font-semibold mb-12 text-gray-800 text-center">Bagaimana Ini Bekerja</h1>
                <section class="flex justify-between gap-4">
                    <template v-for="work in works" :key="work.title">
                        <section class="p-8 rounded-xl bg-gray-100 border border-gray-200">
                            <span
                                class="h-10 w-10 text-green-800 bg-gray-200 border border-gray-200 rounded-xl grid place-items-center">
                                <i :class="work.icon"></i>
                            </span>
                            <h1 class="my-3 text-xl font-semibold text-green-800">{{ work.title }}</h1>
                            <p class="text-sm text-gray-700">{{ work.sub }}</p>
                        </section>
                    </template>
                </section>
            </Container>
        </section>

        <!-- Testimonials -->
        <section class="bg-green-800">
            <Container class="bg-green-800">
                <h1 class="text-5xl font-semibold mb-12 text-gray-100 text-center">Apa Kata Mereka</h1>
                <Splide :options="options" aria-label="Apa Kata Mereka">
                    <template v-for="testimonial in testimonials" :key="testimonial.name">
                        <SplideSlide class="w-3/12 py-10 pl-2">
                            <section
                                class="h-[450px] flex flex-col justify-between rounded-xl bg-gray-200 p-8 mr-5 group hover:bg-green-700 hover:scale-105 hover:border border-green-600 duration-300">
                                <!-- content -->
                                <p class="text-sm text-justify mb-4 group-hover:text-gray-200 duration-300">{{
                                    testimonial.content }}</p>
                                <!-- profile -->
                                <section class="flex gap-2 group-hover:text-gray-200">
                                    <div
                                        class="bg-[url('data:image/jpeg;base64,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')] 
                                                bg-center-bottom bg-cover h-12 w-12 rounded-full border border-gray-200 grid place-items-center group-hover:bg-gray-200">
                                    </div>
                                    <div class="text-sm">
                                        <h2 class="font-semibold">{{ testimonial.name }}</h2>
                                        <p>{{ testimonial.job }}</p>
                                    </div>
                                </section>
                            </section>
                        </SplideSlide>
                    </template>
                </Splide>
            </Container>
        </section>

        <!-- FAQ -->
        <section class="bg-gray-50">
            <Container class="bg-gray-50">
                <h1 class="text-5xl font-semibold mb-12 text-gray-800 text-center">Tanya Jawab</h1>
                <section class="md:w-10/12 mx-auto">
                    <template v-for="faq in faqs" :key="faq.question">
                        <FAQList class="mb-6" :faq="faq"></FAQList>
                    </template>
                </section>
            </Container>
        </section>
    </BaseLayout>
</template>

<script setup>

import { Link } from '@inertiajs/vue3'
import { Splide, SplideSlide } from '@splidejs/vue-splide'
import BaseLayout from '@/Layouts/BaseLayout.vue'
import Container from '@/Components/base/Container.vue'
import Text from '@/Components/form/Text.vue'
import FAQList from '@/Components/FAQList.vue'
import '@splidejs/vue-splide/css'

const options = {
    rewind: true,
    type: 'loop',
    perPage: 3,
    autoplay: true,
    autoWidth: true,
}

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

const works = [
    { title: 'Cari penyedia layanan kesehatan', icon: 'fa-solid fa-search', sub: 'Cukup masukkan lokasi dan jenis layanan yang Anda butuhkan, dan kami akan berikan daftar terkualifikasi.' },
    { title: 'Membandingkan harga', icon: 'fa-solid fa-code-compare', sub: 'Bandingkan harga obat dan layanan untuk mendapatkan penawaran terbaik dengan mudah di platform kami.' },
    { title: 'Baca ulasan dan penilaian', icon: 'fa-solid fa-people-group', sub: 'Baca ulasan dan penilaian dari pengguna lain untuk membuat keputusan tepat dalam memilih penyedia layanan kesehatan.' },
]

const testimonials = [
    {
        name: 'Ibu Ani',
        job: 'Ibu Rumah Tangga',
        content: 'Saya sangat senang dengan layanan dari CekFaskesmu. Sebelumnya saya kesulitan mencari informasi tentang dokter yang tepat untuk anak saya. Namun, setelah menggunakan platform ini, saya mudah menemukan dokter yang sesuai dengan kebutuhan anak saya. Saya juga dapat membandingkan harga obat-obatan dan layanan, sehingga dapat menghemat biaya. Terima kasih CekFaskesmu'
    },
    {
        name: 'Bapak Ahmad',
        job: 'Pengusaha',
        content: 'Saya sangat terbantu dengan layanan CekFaskesmu dalam mencari informasi mengenai layanan kesehatan terbaik untuk keluarga saya. Dengan fitur pencarian yang mudah digunakan dan informasi yang akurat, saya dapat menemukan dokter yang tepat dengan cepat. Saya juga menyukai fitur perbandingan harga, karena dapat membantu saya menemukan layanan yang terjangkau tanpa mengorbankan kualitas. Terima kasih CekFaskesmu'
    },
    {
        name: 'Ibu Siti',
        job: 'Karyawan Swasta',
        content: 'Saya sangat senang menggunakan layanan CekFaskesmu. Dalam waktu singkat, saya dapat menemukan dokter yang tepat untuk kebutuhan kesehatan saya. Saya juga menyukai fitur ulasan dan penilaian, karena membantu saya membuat keputusan yang tepat. Dengan CekFaskesmu, saya merasa lebih mudah dalam mengakses informasi kesehatan yang akurat dan terpercaya.'
    },
    {
        name: 'Bapak Iwan',
        job: 'PNS',
        content: 'Saya sangat terbantu dengan layanan dari CekFaskesmu dalam mencari dokter yang tepat untuk keluarga saya. Dengan fitur pencarian yang mudah digunakan dan informasi yang akurat, saya dapat dengan mudah menemukan dokter yang sesuai dengan kebutuhan keluarga saya. Saya juga merasa lebih aman karena dapat membaca ulasan dan penilaian dari pengguna lain. Terima kasih CekFaskesmu!'
    },
    {
        name: 'Ibu Rina',
        job: 'Wiraswasta',
        content: 'Saya sangat senang dengan layanan dari CekFaskesmu. Sebagai seseorang yang sibuk dengan pekerjaan, saya sering kesulitan dalam mencari informasi tentang layanan kesehatan yang tersedia di sekitar saya. Namun, dengan CekFaskesmu, saya dapat dengan mudah menemukan dokter yang sesuai dengan kebutuhan saya dan keluarga. Terima kasih CekFaskesmu!'
    }
]

const faqs = [
    {
        question: 'Apa itu CekFaskesmu ?',
        answer: 'CekFaskesmu adalah platform yang memungkinkan Anda mencari dan membandingkan penyedia layanan kesehatan di dekat Anda serta membaca ulasan dari pengguna lain.'
    },
    {
        question: 'Apakah penggunaan CekFaskesmu gratis ?',
        answer: 'Ya, penggunaan CekFaskesmu sepenuhnya gratis.'
    },
    {
        question: 'Bagaimana cara menggunakan fitur pencarian di CekFaskesmu ?',
        answer: 'Anda cukup memasukkan lokasi Anda dan jenis layanan kesehatan yang Anda butuhkan, dan CekFaskesmu akan memberikan daftar penyedia terkualifikasi di sekitar Anda.'
    },
    {
        question: 'Apa jenis layanan kesehatan yang dapat dicari di CekFaskesmu ?',
        answer: 'Anda dapat mencari berbagai jenis layanan kesehatan, mulai dari klinik umum hingga rumah sakit spesialis.'
    },
    {
        question: 'Apakah CekFaskesmu menjamin kualitas layanan dari penyedia yang direkomendasikan ?',
        answer: 'CekFaskesmu hanya menyediakan informasi tentang penyedia layanan kesehatan yang telah terdaftar secara resmi dan terkualifikasi, namun tidak menjamin kualitas layanan yang diberikan oleh masing-masing penyedia.'
    },
    {
        question: 'Bagaimana cara membaca ulasan pengguna lain di CekFaskesmu ?',
        answer: 'Anda dapat melihat ulasan pengguna lain dengan mengklik profil penyedia layanan kesehatan yang ingin Anda lihat dan menemukan bagian ulasan dari pengguna lain.CekFaskesmu hanya menyediakan informasi tentang penyedia layanan kesehatan yang telah terdaftar secara resmi dan terkualifikasi, namun tidak menjamin kualitas layanan yang diberikan oleh masing-masing penyedia.'
    },
    {
        question: 'Bagaimana cara memberikan ulasan tentang penyedia layanan kesehatan di CekFaskesmu ?',
        answer: 'Anda dapat memberikan ulasan dengan mengklik profil penyedia layanan kesehatan yang ingin Anda ulas dan menemukan bagian untuk memberikan ulasan.'
    },
    {
        question: 'Apakah CekFaskesmu menyediakan layanan booking untuk janji temu dengan penyedia layanan kesehatan ?',
        answer: 'Saat ini, CekFaskesmu belum menyediakan layanan booking untuk janji temu dengan penyedia layanan kesehatan.'
    },
]

</script>