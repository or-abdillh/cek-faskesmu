<template>
    <section class="relative overflow-x-auto">
        <table id="table" class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="md:px-6 md:py-3">No</th>
                    <th scope="col" class="md:px-6 md:py-3">Nama</th>
                    <th scope="col" class="md:px-6 md:py-3">Biaya Layanan</th>
                    <th scope="col" class="md:px-6 md:py-3">Rating</th>
                    <th scope="col" class="md:px-6 md:py-3">Ulasan</th>
                    <th scope="col" class="md:px-6 md:py-3">Dibuat Pada</th>
                    <th scope="col" class="md:px-6 md:py-3">Diubah Pada</th>
                    <th scope="col" class="md:px-6 md:py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <template v-for="(item, index) in props.items" :key="item.id">
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td>{{ index + 1 }}</td>
                        <th scope="row" class="md:px-6 md:py-4 font-medium text-gray-900">{{ item.name }}
                        </th>
                        <td class="md:px-6 md:py-4 whitespace-nowrap">Rp{{ item.price.toLocaleString() }} /{{ item.unit_type
                        }}
                        </td>
                        <td class="md:px-6 md:py-4"><i class="fa-solid fa-star text-yellow-500"></i> {{ item.rate }}</td>
                        <td class="md:px-6 md:py-4"><i class="fa-solid fa-user-group text-gray-400"></i> {{ item.userHasRate
                        }}
                        </td>
                        <td class="md:px-6 md:py-4">
                            {{ new Date(item.created_at).toLocaleDateString() }}
                            {{ new Date(item.created_at).toLocaleTimeString() }}
                        </td>
                        <td class="md:px-6 md:py-4">
                            {{ new Date(item.updated_at).toLocaleDateString() }}
                            {{ new Date(item.updated_at).toLocaleTimeString() }}
                        </td>
                        <td class="md:px-6 md:py-4">
                            <section class="flex gap-3">
                                <button @click="update(item)" title="Edit Data"><i
                                        class="fa-solid fa-edit text-blue-500"></i></button>
                                <button @click="destroy(item)" title="Hapus Data"><i
                                        class="fa-solid fa-trash text-red-500"></i></button>
                            </section>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </section>
</template>

<script setup>

import { onMounted } from 'vue'
import DataTable from 'datatables.net-dt'

const props = defineProps({
    items: Array
})

const emits = defineEmits(['table:update-action', 'table:delete-action'])

const update = item => emits('table:update-action', item)

const destroy = item => emits('table:delete-action', item)

onMounted(() => {

    // Init table
    let table = new DataTable('#table', {
        // options
    })
})
</script>