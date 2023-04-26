<template>
    <section>
        <!-- CTA -->
        <section class="flex justify-end mb-8">
            <button @click="close" class="bg-green-600 px-3 py-2 rounded-lg text-gray-200"><i class="fa-solid fa-plus"></i>
                Tambah
                Obatan</button>
        </section>
        <!-- table -->
        <DrugTable @table:update-action="update" :items="props.drugs"></DrugTable>
    </section>

    <!-- modal -->
    <Modal :show="showModalCreate">
        <!-- Create -->
        <DrugForm @modal:close="showModalCreate = false" label="Obatan"
            :units="['Kapsul', 'Kaplet', 'Tablet', 'Botol', 'Suntikan', 'Biji']" :is-create="isCreate" :item="item"
            :url="url" :facility="props.facility" :method="method"></DrugForm>
    </Modal>
</template>

<script setup>

import { ref } from 'vue'
import Modal from '@/Components/Modal.vue'
import DrugTable from '@/Pages/Profile/Partials/ServiceDrugTable.vue'
import DrugForm from '@/Components/form/ServiceDrugForm.vue'

const showModalCreate = ref(false)

const item = ref(null)
const isCreate = ref(true)
const method = ref('post')
const url = ref(route('user.drug.store'))

const update = data => {
    item.value = data
    isCreate.value = false
    method.value = 'patch'
    url.value = route('user.drug.update', data.id);
    showModalCreate.value = true
}

const close = () => {
    item.value = null
    isCreate.value = true
    method.value = 'post'
    url.value = route('user.drug.store')
    showModalCreate.value = true
}

const props = defineProps({
    drugs: Array,
    facility: Object
})

</script>