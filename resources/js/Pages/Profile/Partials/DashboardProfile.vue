<template>
    <section>
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
                <TextInput id="phone_number" type="tel" class="mt-1 block w-full" v-model="form.phone_number" required>
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
                    <TextInput id="longitude" type="text" class="mt-1 block w-full" v-model="form.longitude" required>
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
                class="bg-green-500 w-full py-2 rounded-md text-gray-200">
                <i v-if="form.processing" class="fa-solid fa-spinner spinner"></i>
                <template v-else>Simpan</template>
            </button>
        </form>
    </section>

    <!-- modal -->
    <Modal :show="showModal" max-width="md">
        <MapPicker @map:picker="getMapPicker" :lat="form.latitude" :lng="form.longitude" @modal:close="showModal = false">
        </MapPicker>
    </Modal>
</template>

<script setup>

import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { useNotification } from '@kyvg/vue3-notification'
import TextInput from '@/Components/TextInput.vue'
import InputLabel from '@/Components/InputLabel.vue'
import InputError from '@/Components/InputError.vue'
import Modal from '@/Components/Modal.vue'
import MapPicker from '@/Pages/Profile/Partials/MapPicker.vue'

const showModal = ref(false)

const { notify } = useNotification()

const props = defineProps({
    profile: Object,
    locations: Array
})

const form = useForm({
    name: props.profile?.name,
    location_id: props?.profile?.location_id,
    category: props.profile?.category,
    description: props.profile?.description,
    address: props.profile?.address,
    phone_number: props.profile?.phone_number,
    website: props.profile?.website,
    longitude: props.profile?.longitude,
    latitude: props.profile?.latitude
})

const getMapPicker = map => {
    const { longitude, latitude } = map
    form.longitude = longitude
    form.latitude = latitude
}

const submit = () => {
    form.patch(route('user.facility.update', props.profile?.id), {
        onSuccess() {
            notify({
                title: 'Pemberitahuan',
                text: 'Profile fasilitas anda telah berhasil di ubah'
            })
        }
    })
}

const categories = ['Rumah Sakit', 'Apotek', 'Klinik', 'Praktek']
</script>