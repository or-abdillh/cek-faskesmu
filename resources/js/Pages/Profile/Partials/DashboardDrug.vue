<template>
    <section>
        <!-- CTA -->
        <section class="flex justify-end mb-8">
            <button @click="close" class="bg-green-600 px-3 py-2 rounded-lg text-gray-200"><i class="fa-solid fa-plus"></i>
                Tambah
                Obatan</button>
        </section>
        <!-- table -->
        <DrugTable @table:update-action="update" @table:delete-action="destroy" :items="props.drugs"></DrugTable>
    </section>

    <!-- modal -->
    <Modal :show="showModal">
        <DrugForm @modal:close="showModal = false" label="Obatan"
            :units="['Kapsul', 'Kaplet', 'Tablet', 'Botol', 'Suntikan', 'Biji']" :is-create="isCreate" :item="item"
            :url="url" :facility="props.facility" :method="method"></DrugForm>
    </Modal>

    <!-- modal delete -->
    <Modal :show="showModalDelete">
        <section class="p-6">
            <!-- header -->
            <section class="text-gray-700 flex justify-between mb-8">
                <button @click="showModalDelete = false"><i class="fa-solid fa-times"></i></button>
                <h1 class="text-xl">{{ deletedItem.name }}, yakin ingin dihapus ?</h1>
                <span></span>
            </section>

            <!-- form -->
            <section>
                <p class="text-gray-700 mb-4">Tindakan ini akan menghapus semua data yang terkait dengan item ini secara
                    permanen
                </p>
                <!-- cta -->
                <form @submit.prevent="submit" class="flex justify-end">
                    <button :disabled="form.processing"
                        class="bg-red-500 px-5 py-2 rounded-xl text-gray-100 disabled:bg-opacity-50 duration-300">
                        <i v-if="form.processing" class="fa-solid fa-spinner spinner"></i>
                        <template v-else>Hapus</template>
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
import DrugTable from '@/Pages/Profile/Partials/ServiceDrugTable.vue'
import DrugForm from '@/Components/form/ServiceDrugForm.vue'

const showModal = ref(false)
const showModalDelete = ref(false)

const item = ref(null)
const isCreate = ref(true)
const method = ref('post')
const url = ref(route('user.drug.store'))
const deletedItem = ref(null)

const form = useForm({})
const { notify } = useNotification()

const update = data => {
    item.value = data
    isCreate.value = false
    method.value = 'patch'
    url.value = route('user.drug.update', data.id);
    showModal.value = true
}

const destroy = data => {
    showModalDelete.value = true
    deletedItem.value = data
}

const close = () => {
    item.value = null
    isCreate.value = true
    method.value = 'post'
    url.value = route('user.drug.store')
    showModal.value = true
}

const submit = () => {
    form.delete(route('user.drug.destroy', deletedItem.value.id), {
        onSuccess() {
            showModalDelete.value = false
            notify({
                title: 'Pemberitahuan',
                text: 'Sukses menghapus item obatan dari database'
            })
        },
        onError(err) {
            console.log(err)
        }
    })
}

const props = defineProps({
    drugs: Array,
    facility: Object
})

</script>