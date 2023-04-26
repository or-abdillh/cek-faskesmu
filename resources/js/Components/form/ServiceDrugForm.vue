<template>
    <section class="p-6">
        <!-- header -->
        <section class="text-gray-700 flex justify-between mb-8">
            <button @click="close"><i class="fa-solid fa-times"></i></button>
            <h1 class="text-xl">Form {{ props.label }}</h1>
            <span></span>
        </section>
        <!-- form -->
        <form @submit.prevent="submit">
            <!-- name -->
            <section class="mb-4">
                <InputLabel for="name" :value="'Nama ' + props.label"></InputLabel>
                <TextInput type="text" class="block w-full mt-1" v-model="form.name" required></TextInput>
                <InputError :message="form.errors.name"></InputError>
            </section>
            <section class="mb-4 flex gap-4">
                <!-- price -->
                <section class="w-full">
                    <InputLabel for="price" :value="'Biaya ' + props.label"></InputLabel>
                    <TextInput type="number" class="block w-full mt-1" v-model="form.price" required></TextInput>
                    <InputError :message="form.errors.price"></InputError>
                </section>
                <!-- unit -->
                <section class="w-full">
                    <InputLabel for="unit_type" value="Satuan Biaya"></InputLabel>
                    <select v-model="form.unit_type" name="unit_type"
                        class="mt-1 block w-full border border-gray-300 bg-gray-100 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm p-2"
                        required>
                        <template v-for="unit in props.units" :key="unit">
                            <option :value="unit">{{ unit }}</option>
                        </template>
                    </select>
                    <InputError :message="form.errors.unit_type"></InputError>
                </section>
            </section>
            <!-- description -->
            <section class="mb-10">
                <InputLabel for="description" :value="'Deskripsi ' + props.label"></InputLabel>
                <textarea v-model="form.description"
                    class="mt-1 block w-full border border-gray-300 bg-gray-100 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm p-2"
                    name="description" cols="30" rows="4" required></textarea>
                <InputError :message="form.errors.description"></InputError>
            </section>
            <!-- cta -->
            <button class="bg-green-500 w-full py-2 rounded-md text-gray-200">
                <i v-if="form.processing" class="fa-solid fa-spinner spinner"></i>
                <template v-else>{{ props.isCreate ? 'Tambahkan' : 'Simpan Perubahan' }}</template>
            </button>
        </form>
    </section>
</template>

<script setup>

import { useForm } from '@inertiajs/vue3'
import { useNotification } from '@kyvg/vue3-notification'
import TextInput from '@/Components/TextInput.vue'
import InputLabel from '@/Components/InputLabel.vue'
import InputError from '@/Components/InputError.vue'

const { notify } = useNotification()

const props = defineProps({
    item: Object,
    label: String,
    units: Array,
    isCreate: Boolean,
    url: String,
    method: String,
    facility: Object
})

const emits = defineEmits(['modal:close'])

const close = () => {
    setTimeout(() => {
        emits('modal:close')
    }, 200);
}

const form = useForm({
    facility_id: props.item?.facility_id || props.facility?.id || '',
    name: props.item?.name || '',
    price: props.item?.price || '',
    description: props.item?.description || '',
    unit_type: props.item?.unit_type || ''
})

const submit = () => {
    form.submit(props.method, props.url, {
        onSuccess() {
            notify({
                title: 'Pemberitahuan',
                text: props.isCreate ? 'Sukses menambahkan data baru' : 'Sukses menyimpan perubahan'
            })
            form.reset()
            emits('modal:close')
        },
        onError(err) {
            console.log(err)
        }
    })
}

</script>