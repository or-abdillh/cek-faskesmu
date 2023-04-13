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
            <Container class="flex justify-around bg-green-800 -translate-y-10">
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
                <!-- searchbar -->
                <section class="md:w-8/12 mx-auto">
                    <Text></Text>
                </section>
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
                                        class="h-12 w-12 rounded-full border border-gray-200 grid place-items-center group-hover:bg-gray-200">
                                        <i class="fa-solid fa-user text-gray-800"></i>
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