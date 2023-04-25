<template>
    <DrugTable :items="props.drugs"></DrugTable>
</template>

<script setup>

import DrugTable from '@/Pages/Profile/Partials/ServiceDrugTable.vue'

const props = defineProps({
    drugs: Array
})

</script>