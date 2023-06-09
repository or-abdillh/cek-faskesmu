<template>
    <Transition enter-active-class="ease-out duration-300" enter-from-class="opacity-0" enter-to-class="opacity-100"
        leave-active-class="ease-in duration-200" leave-from-class="opacity-100" leave-to-class="opacity-0">

        <main v-if="!showReviewPage">
            <!-- copywriter -->
            <h1 class="text-2xl text-green-800 mb-2">Selamat Datang</h1>
            <p class="mb-6 text-gray-800">Di halaman kami yang menampilkan berbagai layanan kesehatan yang tersedia di
                faskes
                kami. Kami
                menyediakan
                berbagai jenis layanan kesehatan untuk memenuhi kebutuhan Anda dan keluarga.</p>
            <!-- searching -->
            <SearchBar>
                <TextInput @keydown.enter="filtering" :use-outline="false" v-model="keyword" list="services"
                    class="w-11/12 bg-gray-200 py-4 px-3 outline-none">
                </TextInput>
                <datalist id="services">
                    <template v-for="service in props.services" :key="service.id">
                        <option :value="service.name"></option>
                    </template>
                </datalist>
            </SearchBar>

            <!-- cards -->
            <section class="w-full md:columns-2">
                <template v-for="service in filteredItems" :key="service?.id">
                    <ServiceCard @card:open-review-page="openReviewPage" type="App\Models\Service" :data="service"
                        class="break-inside-avoid"></ServiceCard>
                </template>
            </section>
        </main>

        <!-- Review page by one service -->
        <ServiceReviews @review-page:show-modal="showModal = true" :item="itemRef.name" :reviews="reviewsRef"
            @review-page:close="showReviewPage = false" v-else>
        </ServiceReviews>
    </Transition>

    <!-- modal -->
    <Modal :show="showModal" max-width="md">
        <UserReview :item="itemRef" type="App\Models\Service" @modal:finish="pushNewReview"
            @modal:close="showModal = false"></UserReview>
    </Modal>
</template>

<script setup>

import { ref, onMounted } from 'vue'
import TextInput from '@/Components/TextInput.vue'
import SearchBar from '@/Pages/Facility/partials/SearchBar.vue'
import ServiceCard from '@/Components/card/ServiceDrugCard.vue'
import ServiceReviews from '@/Pages/Facility/partials/ServiceDrugReviews.vue'
import Modal from '@/Components/Modal.vue'
import UserReview from '@/Components/form/UserReview.vue'

const showReviewPage = ref(false)
const reviewsRef = ref([])
const itemRef = ref()
const showModal = ref(false)
const keyword = ref('')

const openReviewPage = data => {
    const { reviews, item } = data

    showReviewPage.value = true
    reviewsRef.value = reviews
    itemRef.value = item
}

const pushNewReview = review => reviewsRef.value.unshift(review)

const props = defineProps({
    services: Array
})

const filteredItems = ref(props.services)

const filtering = () => filteredItems.value = props.services.filter(service => service.name.toLowerCase().includes(keyword.value.toLowerCase()))

onMounted(() => {
    // Get param key and type
    const queryParams = new URLSearchParams(window.location.search)
    const key = queryParams.get('key') || ''
    const type = queryParams.get('type') || ''

    if (type.toLowerCase() === 'service' && key.length > 0) {
        keyword.value = key
        filtering()
    }
})

</script>