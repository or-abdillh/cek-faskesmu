<template>
    <section class="flex items-center gap-2">
        <div v-if="props.useIcon" class="h-8 w-8 bg-blue-800 rounded-full grid place-items-center">
            <i class="text-xs fa-solid fa-house-medical text-white"></i>
        </div>
        <h1 class="text-3xl font-semibold tracking-wide">
            <span class="text-blue-700">Cek</span>
            <span class="text-green-600">Faskesmu</span>
        </h1>
    </section>
</template>

<script setup>

const props = defineProps({
    useIcon: {
        type: Boolean,
        default: true,
    }
})

</script>