<template>
    <section>
        <!-- CTA -->
        <section class="flex justify-end mb-8">
            <button @click="showModal = true" class="bg-green-600 px-3 py-2 rounded-lg text-gray-200"><i
                    class="fa-solid fa-plus"></i> Tambah
                Obatan</button>
        </section>
        <!-- table -->
        <DrugTable :items="props.drugs"></DrugTable>
    </section>

    <!-- modal -->
    <Modal :show="showModal">
        <DrugForm @modal:close="showModal = false" label="Obatan"
            :units="['Kapsul', 'Kaplet', 'Tablet', 'Botol', 'Suntikan', 'Biji']" :is-create="true"
            :url="route('user.drug.store')" :facility="props.facility" method="post"></DrugForm>
    </Modal>
</template>

<script setup>

import { ref } from 'vue'
import Modal from '@/Components/Modal.vue'
import DrugTable from '@/Pages/Profile/Partials/ServiceDrugTable.vue'
import DrugForm from '@/Components/form/ServiceDrugForm.vue'

const showModal = ref(false)

const props = defineProps({
    drugs: Array,
    facility: Object
})

</script>