<style scoped>
.btn {
    @apply block px-5 py-2 rounded-full;
}
</style>

<template>
    <!-- hapus faskes -->
    <section class="mb-12 md:mb-4 flex flex-col md:flex-row justify-between md:items-center">
        <section class="md:w-9/12">
            <h1 class="text-gray-700 font-semibold mb-2">Fasilitas Kesehatan</h1>
            <p class="text-gray-600 mb-2">
                Dengan menekan tombol ini, semua data terkait dengan fasilitas akan dihapus, seperti seluruh layanan dan
                obatan yang sudah ada dan
                peran
                pengguna akan dikembalikan
                menjadi pengguna biasa.</p>
        </section>
        <span>
            <button @click="reset(route('user.reset.facility'), true)" class="btn bg-red-500 text-gray-100">Hapus
                Fasilitas</button>
        </span>
    </section>

    <!-- hapus faskes -->
    <section class="mb-12 md:mb-4 flex-col md:flex-row justify-between md:items-center">
        <section class="md:w-9/12">
            <h1 class="text-gray-700 font-semibold mb-2">Layanan atau Obatan</h1>
            <p class="text-gray-600 mb-2">
                Menghapus semua data layanan pada fasilitas beserta data yang terkait, seperti ulasan
                dan rating para pengguna lainnya serta data para pengguna yang menyimpan beberapa layanan atau obatan pada
                faskes ini
                pada akun mereka
            </p>
        </section>
        <span class="flex flex-col gap-2">
            <button @click="reset(route('user.reset.service'))" class="btn bg-red-500 text-gray-100">Reset Layanan</button>
            <button @click="reset(route('user.reset.drug'))" class="btn bg-red-500 text-gray-100">Reset Obatan</button>
        </span>
    </section>

    <!-- modal -->
    <Modal :show="showModal">
        <section class="p-6">
            <!-- header -->
            <section class="text-gray-700 flex justify-between mb-8">
                <button @click="showModal = false"><i class="fa-solid fa-times"></i></button>
                <h1 class="text-xl">Yakin melakukan reset data ?</h1>
                <span></span>
            </section>

            <section>
                <p class="text-gray-700 mb-4">
                    Tindakan ini bersifat menghapus data secara permanen dan tidak memungkinkan adanya pengembalian data
                </p>

                <!-- form -->
                <form class="flex justify-end" @submit.prevent="submit">
                    <button :disabled="form.processing"
                        class="bg-red-500 px-5 py-2 rounded-xl text-gray-100 disabled:bg-opacity-50 duration-300">
                        <i v-if="form.processing" class="fa-solid fa-spinner spinner"></i>
                        <template v-else>Reset</template>
                    </button>
                </form>
            </section>
        </section>
    </Modal>
</template>

<script setup>

import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { useNotification } from '@kyvg/vue3-notification'
import Modal from '@/Components/Modal.vue'

const { notify } = useNotification()
const showModal = ref(false)
const urlRef = ref(null)
const form = useForm({})
const isFacilityReset = ref(false)

const reset = (url, isFacility = false) => {
    showModal.value = true
    urlRef.value = url
    isFacilityReset.value = isFacility
}

const submit = () => {
    // console.log(urlRef.value)
    form.delete(urlRef.value, {
        onSuccess() {
            showModal.value = false
            notify({
                title: 'Pemberitahuan',
                text: 'Sukses melakukan reset data'
            })

            if (isFacilityReset.value) location.reload()
        },
        onError(err) {
            console.log(err)
        }
    })
}

</script>