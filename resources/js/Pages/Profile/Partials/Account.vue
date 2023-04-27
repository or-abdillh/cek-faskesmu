<template>
    <section>
        <!-- header -->
        <section class="flex flex-col md:flex-row md:justify-between items-center gap-4 mb-12">
            <!-- bio -->
            <section>
                <h1 class="text-2xl text-gray-700 mb-2">{{ $page.props.auth.user.name }}</h1>
                <section class="text-gray-600 flex flex-col md:flex-row gap-4 text-sm">
                    <!-- role -->
                    <span><i class="fa-solid fa-user-shield mr-1"></i>{{
                        $page.props.auth.user.roles[0].name }}</span>

                    <!-- last login at -->
                    <span>
                        <i class="fa-solid fa-stopwatch"></i>
                        Terakhir kali login pada
                        {{ new Date($page.props.auth.user.last_login_at).toLocaleDateString() }}
                        {{ new Date($page.props.auth.user.last_login_at).toLocaleTimeString() }}
                    </span>
                </section>
            </section>
            <!-- avatar -->
            <section>
                <img class="rounded-full" width="60"
                    :src="`https://ui-avatars.com/api/?background=228B22&color=fff&name=${$page?.props?.auth?.user?.name}`"
                    alt="">
            </section>
        </section>

        <!-- main -->
        <main>
            <!-- Update profile -->
            <UpdateProfileInformationForm class="mb-12 pb-4 border-b border-gray-200"></UpdateProfileInformationForm>
            <!-- Change password -->
            <UpdatePasswordForm class="mb-12 pb-4 border-b border-gray-200"></UpdatePasswordForm>

            <!-- Create facility -->
            <section v-if="$page.props.auth.user.roles[0].name === 'user'">
                <header class="mb-8">
                    <h2 class="text-lg font-medium text-gray-900">Buat Fasilitas</h2>

                    <p class="mt-1 text-sm text-gray-600">
                        Mulailah mengelola fasilitas kesehatan anda sendiri dan beri dampak positif ke pengguna lain
                    </p>
                </header>

                <!-- form -->
                <form @submit.prevent="submit">
                    <!-- name -->
                    <section class="mb-6">
                        <InputLabel for="name" value="Nama Fasilitas"></InputLabel>
                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required></TextInput>
                        <InputError :message="form.errors.name"></InputError>
                    </section>

                    <!-- location -->
                    <section class="mb-6">
                        <InputLabel for="location_id" value="Lokasi Faskes"></InputLabel>
                        <select
                            class="mt-1 block w-full border border-gray-300 bg-gray-100 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm p-2"
                            name="location_id" v-model="form.location_id" id="location_id">
                            <template v-for="location in props.locations" :key="location.id">
                                <option :value="location.id">{{ location.city }}</option>
                            </template>
                        </select>
                        <InputError :message="form.errors.location_id"></InputError>
                    </section>

                    <!-- category -->
                    <section class="mb-6">
                        <InputLabel for="category" value="Kategori Faskes"></InputLabel>
                        <select
                            class="mt-1 block w-full border border-gray-300 bg-gray-100 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm p-2"
                            name="category" v-model="form.category" id="category">
                            <template v-for="category in categories" :key="category">
                                <option :value="category">{{ category }}</option>
                            </template>
                        </select>
                        <InputError :message="form.errors.category"></InputError>
                    </section>

                    <!-- description -->
                    <section class="mb-6">
                        <InputLabel for="description" value="Deskripsi Faskes"></InputLabel>
                        <textarea
                            class="mt-1 block w-full border border-gray-300 bg-gray-100 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm p-2"
                            name="description" v-model="form.description" id="description" cols="30" rows="4"></textarea>
                        <InputError :message="form.errors.description"></InputError>
                    </section>

                    <!-- address -->
                    <section class="mb-6">
                        <InputLabel for="address" value="Alamat Lengkap"></InputLabel>
                        <textarea
                            class="mt-1 block w-full border border-gray-300 bg-gray-100 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm p-2"
                            name="address" v-model="form.address" id="address" cols="30" rows="4"></textarea>
                        <InputError :message="form.errors.address"></InputError>
                    </section>

                    <!-- phone number -->
                    <section class="mb-6">
                        <InputLabel for="phone_number" value="Nomor Telepon"></InputLabel>
                        <TextInput id="phone_number" type="tel" class="mt-1 block w-full" v-model="form.phone_number"
                            required>
                        </TextInput>
                        <InputError :message="form.errors.phone_number"></InputError>
                    </section>

                    <!-- website -->
                    <section class="mb-6">
                        <InputLabel for="website" value="Website Faskes"></InputLabel>
                        <TextInput id="website" type="web" class="mt-1 block w-full" v-model="form.website">
                        </TextInput>
                        <InputError :message="form.errors.website"></InputError>
                    </section>

                    <!-- coordinats -->
                    <section class="flex gap-4 mb-12">
                        <!-- longitude -->
                        <section>
                            <InputLabel for="longitude" value="Longitude Faskes"></InputLabel>
                            <TextInput id="longitude" type="text" class="mt-1 block w-full" v-model="form.longitude"
                                required>
                            </TextInput>
                            <InputError :message="form.errors.longitude"></InputError>
                        </section>

                        <!-- longitude -->
                        <section>
                            <InputLabel for="latitude" value="Latitude Faskes"></InputLabel>
                            <TextInput id="latitude" type="text" class="mt-1 block w-full" v-model="form.latitude" required>
                            </TextInput>
                            <InputError :message="form.errors.latitude"></InputError>
                        </section>

                        <!-- leafler picker -->
                        <section class="flex flex-col justify-end">
                            <button type="button" @click="showModal = true"
                                class="bg-gray-200 px-3 py-2 rounded-md border border-gray-300">Pilih
                                Via Map</button>
                        </section>
                    </section>

                    <!-- submit -->
                    <button type="submit" :class="{ 'bg-opacity-50': form.processing }"
                        class="bg-green-500 w-full py-2 rounded-md text-gray-100">
                        <i v-if="form.processing" class="fa-solid fa-spinner spinner"></i>
                        <template v-else>Fasilitas Baru</template>
                    </button>
                </form>
            </section>
        </main>
    </section>

    <!-- modal -->
    <Modal :show="showModal" max-width="md">
        <MapPicker @map:picker="getMapPicker" :lat="form.latitude" :lng="form.longitude" @modal:close="showModal = false">
        </MapPicker>
    </Modal>
</template>

<script setup>

import { ref } from 'vue'
import { useForm, usePage } from '@inertiajs/vue3'
import { useNotification } from '@kyvg/vue3-notification'
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue'
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue'
import Modal from '@/Components/Modal.vue'
import MapPicker from '@/Pages/Profile/Partials/MapPicker.vue'
import TextInput from '@/Components/TextInput.vue'
import InputLabel from '@/Components/InputLabel.vue'
import InputError from '@/Components/InputError.vue'

const showModal = ref(false)

const props = defineProps({
    locations: Array
})

const emits = defineEmits('account:create-facility')

const page = usePage()
const { notify } = useNotification()

const form = useForm({
    name: '',
    user_id: page.props.auth?.user?.id,
    location_id: '',
    category: '',
    description: '',
    address: '',
    phone_number: '',
    website: '',
    longitude: 0,
    latitude: 0
})

const getMapPicker = map => {
    const { longitude, latitude } = map
    form.longitude = longitude
    form.latitude = latitude
}

const submit = () => {
    form.post(route('user.facility.store'), {
        onSuccess() {
            notify({
                title: 'Pemberitahuan',
                text: 'Berhasil membuat fasilitas baru'
            })
            emits('account:create-facility')
            location.reload()
        },
        onError(err) {
            console.log(err)
        }
    })
}

const categories = ['Rumah Sakit', 'Apotek', 'Klinik', 'Praktek']

</script>