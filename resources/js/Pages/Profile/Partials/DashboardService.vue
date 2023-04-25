<template>
    <ServiceTable :items="props.services"></ServiceTable>
</template>

<script setup>

import ServiceTable from '@/Pages/Profile/Partials/ServiceDrugTable.vue'

const props = defineProps({
    services: Array
})

</script>