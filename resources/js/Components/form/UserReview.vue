<template>
    <section class="p-6">
        <!-- header -->
        <section class="text-gray-700 flex justify-between mb-8">
            <button @click="close"><i class="fa-solid fa-times"></i></button>
            <h1 class="text-xl">{{ props?.item?.name }}</h1>
            <span></span>
        </section>

        <!-- profile -->
        <section class="flex gap-4 mb-8">
            <!-- avatar -->
            <span><img class="rounded-full" width="50"
                    :src="`https://ui-avatars.com/api/?background=228B22&color=fff&name=${$page.props.auth.user.name}`"></span>
            <!-- stat and name -->
            <section>
                <h1 class="text-gray-800 text-lg">{{ $page.props.auth.user.name }}</h1>
                <p class="text-gray-600 text-sm">Memberikan ulasan secara publik</p>
            </section>
        </section>

        <!-- rating picker -->
        <section class="flex justify-center gap-12 text-3xl text-yellow-400 mb-8">
            <!-- solid star -->
            <template v-for="star in rate" :key="star">
                <button :title="rateTitles[star - 1]" @click="rate = star"><i class="fa-solid fa-star"></i></button>
            </template>
            <!-- transparent star -->
            <template v-if="5 - rate > 0" v-for="star in 5 - rate" :key="star">
                <button :title="rateTitles[star + rate - 1]" @click="rate = + star + rate"><i
                        class="fa-regular fa-star"></i></button>
            </template>
        </section>

        <!-- review text area -->
        <form @submit.prevent="submit" class="flex flex-col gap-2">
            <label class="text-gray-700" for="content">Ceritakan pengalaman anda</label>
            <textarea v-model="form.content" placeholder="Bagikan pengalaman anda kepada pengguna lain"
                class="bg-gray-50 border border-gray-300 rounded-xl p-3 mb-8" id="content" cols="30" rows="3"
                required></textarea>

            <button type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                class="bg-blue-800 text-gray-200 rounded-full py-2">
                <i v-if="form.processing" class="fa-solid fa-spinner spinner"></i>
                <span v-else>Posting</span>
            </button>
        </form>
    </section>
</template>

<script setup>

import { ref } from 'vue'
import { useForm, usePage } from '@inertiajs/vue3'
import { useNotification } from '@kyvg/vue3-notification'

const { notify } = useNotification()

const page = usePage()

const emits = defineEmits(['modal:close', 'modal:finish'])

const props = defineProps({
    item: Object,
    type: String
})

const close = () => {
    setTimeout(() => {
        emits('modal:close')
    }, 200);
}

const rate = ref(1)

const form = useForm({
    rate: 1,
    content: '',
    user_id: page.props.auth.user.id,
    reviewable_id: props?.item?.id,
    reviewable_type: props?.type
})

const submit = () => {
    form.rate = rate.value
    form.post('/review', {
        onSuccess() {
            emits('modal:close')

            emits('modal:finish', {
                username: page.props.auth.user.name,
                rate: rate.value,
                content: form.content,
                created_at: 'a few second ago',
            })

            notify({
                title: 'Pemberitahuan',
                text: 'Sukses melakukan posting ulasan'
            })
        }
    })
}

const rateTitles = ['Benci', 'Tidak Suka', 'Lumayan', 'Suka', 'Suka Sekali']

</script>