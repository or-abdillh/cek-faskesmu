<template>
    <BaseLayoutCard>
        <!-- thumbnail -->
        <section
            class="w-full flex py-4 justify-end pr-4 rounded-xl shadow h-44 bg-top bg-cover bg-[url('https://cdn0-production-assets-kly.akamaized.net/medias/1411942/small-portrait/059095200_1479717151-24.jpg')]">
            <button v-if="$page.props.auth.user" :title="isFavorited ? 'Tersimpan' : 'Simpan'" @click="favorited"
                class="w-10 h-10 hover:bg-opacity-75 active:scale-105 duration-300 grid place-items-center rounded-full bg-gray-100 bg-opacity-50 backdrop-blur">
                <i v-if="form.processing" class="fa-solid fa-spinner spinner text-gray-500"></i>
                <i v-else :class="isFavorited ? 'fa-solid text-gray-200' : 'fa-regular text-gray-200'"
                    class="fa-bookmark"></i></button>
        </section>
        <!-- copywriter -->
        <section class="py-4">
            <!-- location -->
            <span class="text-gray-600 text-sm">
                {{ props.facility?.location }}
            </span>
            <!-- name -->
            <h1 class="text-gray-700 text-lg font-semibold mt-1 mb-3">{{ props.facility?.name }}</h1>
            <!-- information -->
            <section class="w-full text-sm text-gray-500 flex gap-4 mb-6">
                <!-- category -->
                <span>
                    <i class="fa-solid fa-house-medical"></i>
                    {{ props.facility?.category }}
                </span>
                <!-- rate -->
                <span>
                    <i class="fa-solid fa-star"></i>
                    {{ props?.facility?.rate }}
                </span>
                <!-- reviews -->
                <span>
                    <i class="fa-solid fa-user-group"></i>
                    {{ props?.facility?.userHasRate }}
                </span>
            </section>
            <!-- CTA -->
            <Link class="block px-4 py-2 bg-green-800 text-center rounded-xl text-lg text-gray-100"
                :href="props.facility?.URL">Kunjungi
            </Link>
        </section>
    </BaseLayoutCard>
</template>

<script setup>

import { ref } from 'vue'
import { Link, useForm, usePage } from '@inertiajs/vue3'
import { useNotification } from '@kyvg/vue3-notification'
import BaseLayoutCard from '@/Components/card/BaseLayoutCard.vue'

const { notify } = useNotification()

const props = defineProps({
    facility: Object,
})

const isFavorited = ref(props?.facility?.isUserFavorite ? true : false)

const page = usePage()

const form = useForm({
    user_id: page.props.auth.user.id,
    favoritable_id: props?.facility?.id,
    favoritable_type: 'App\\Models\\Facility',
    item: props.facility?.name
})

const favorited = () => {
    try {
        form.post('/favorite', {
            onSuccess() {
                isFavorited.value = !isFavorited.value
                notify({
                    title: 'Pemberitahuan',
                    text: isFavorited.value ? 'Berhasil menambahkan item favorit' : 'Hapus item dari favorit'
                })
            }
        })
    } catch (err) {
        console.error(err)
    }
}

</script>