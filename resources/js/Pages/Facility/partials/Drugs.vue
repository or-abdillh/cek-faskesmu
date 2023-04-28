<template>
    <Transition enter-active-class="ease-out duration-300" enter-from-class="opacity-0" enter-to-class="opacity-100"
        leave-active-class="ease-in duration-200" leave-from-class="opacity-100" leave-to-class="opacity-0">

        <main v-if="!showReviewPage">
            <!-- copywriter -->
            <h1 class="text-green-800 text-2xl mb-2">Selamat Datang</h1>
            <p class="text-gray-800 mb-6">
                Temukan obatan yang Anda butuhkan di faskes kami. Kami menyediakan berbagai jenis obat seperti kapsul,
                kaplet,
                tablet, botol, suntikan, dan biji dengan harga yang terjangkau. </p>
            <!-- searching -->
            <SearchBar>
                <TextInput @keydown.enter="filtering" :use-outline="false" v-model="keyword"
                    class="w-11/12 bg-gray-200 py-4 px-3 outline-none">
                </TextInput>
            </SearchBar>

            <!-- cards -->
            <section class="w-full md:columns-2">
                <template v-for="drug in filteredItems" :key="drug?.id">
                    <DrugCard @card:open-review-page="openReviewPage" class="break-inside-avoid" type="App\Models\Drug"
                        :data="drug"></DrugCard>
                </template>
            </section>
        </main>

        <!-- Review page by one drug -->
        <DrugReviews @review-page:show-modal="showModal = true" :item="itemRef.name" :reviews="reviewsRef"
            @review-page:close="showReviewPage = false" v-else>
        </DrugReviews>
    </Transition>

    <!-- modal -->
    <Modal :show="showModal" max-width="md">
        <UserReview :item="itemRef" type="App\Models\Drug" @modal:finish="pushNewReview" @modal:close="showModal = false">
        </UserReview>
    </Modal>
</template>

<script setup>

import { ref, onMounted } from 'vue'
import DrugReviews from '@/Pages/Facility/partials/ServiceDrugReviews.vue'
import TextInput from '@/Components/TextInput.vue'
import SearchBar from '@/Pages/Facility/partials/SearchBar.vue'
import DrugCard from '@/Components/card/ServiceDrugCard.vue'
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
    drugs: Array
})

const filteredItems = ref(props.drugs)

const filtering = () => filteredItems.value = props.drugs.filter(drug => drug.name.toLowerCase().includes(keyword.value.toLowerCase()))

onMounted(() => {
    // Get param key and type
    const queryParams = new URLSearchParams(window.location.search)
    const key = queryParams.get('key') || ''
    const type = queryParams.get('type') || ''

    if (type.toLowerCase() === 'drug' && key.length > 0) {
        keyword.value = key
        filtering()
    }
})
</script>