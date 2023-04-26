<template>
    <section>
        <!-- CTA -->
        <section class="flex justify-end mb-8">
            <button @click="showModal = true" class="bg-green-600 px-3 py-2 rounded-lg text-gray-200"><i
                    class="fa-solid fa-plus"></i> Tambah
                Layanan</button>
        </section>
        <!-- table -->
        <ServiceTable :items="props.services"></ServiceTable>
    </section>
    <!-- modal -->
    <!-- create service -->
    <Modal :show="showModal">
        <ServiceForm @modal:close="showModal = false" :facility="props.facility" label="Layanan"
            :units="['Jam', 'Sesi', 'Hari']" :is-create="true" :url="route('user.service.store')" method="post">
        </ServiceForm>
    </Modal>
</template>

<script setup>

import { ref } from 'vue'
import Modal from '@/Components/Modal.vue'
import ServiceTable from '@/Pages/Profile/Partials/ServiceDrugTable.vue'
import ServiceForm from '@/Components/form/ServiceDrugForm.vue'

const showModal = ref(false)

const props = defineProps({
    services: Array,
    facility: Object
})

</script>