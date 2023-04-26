<template>
    <section>
        <!-- CTA -->
        <section class="flex justify-end mb-8">
            <button @click="close" class="bg-green-600 px-3 py-2 rounded-lg text-gray-200"><i class="fa-solid fa-plus"></i>
                Tambah
                Layanan</button>
        </section>
        <!-- table -->
        <ServiceTable @table:update-action="update" :items="props.services"></ServiceTable>
    </section>
    <!-- modal -->
    <Modal :show="showModal">
        <ServiceForm @modal:close="showModal = false" :item="item" :facility="props.facility" label="Layanan"
            :units="['Jam', 'Sesi', 'Hari']" :is-create="true" :url="url" :method="method">
        </ServiceForm>
    </Modal>
</template>

<script setup>

import { ref } from 'vue'
import Modal from '@/Components/Modal.vue'
import ServiceTable from '@/Pages/Profile/Partials/ServiceDrugTable.vue'
import ServiceForm from '@/Components/form/ServiceDrugForm.vue'

const showModal = ref(false)

const item = ref(null)
const isCreate = ref(true)
const method = ref('post')
const url = ref(route('user.service.store'))

const update = data => {
    item.value = data
    isCreate.value = false
    method.value = 'patch'
    url.value = route('user.service.update', data.id);
    showModal.value = true
}

const close = () => {
    item.value = null
    isCreate.value = true
    method.value = 'post'
    url.value = route('user.service.store')
    showModal.value = true
}

const props = defineProps({
    services: Array,
    facility: Object
})

</script>