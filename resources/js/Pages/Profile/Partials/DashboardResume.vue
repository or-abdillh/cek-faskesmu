<template>
    <section>
        <p class="mb-4 text-gray-700">Berikut ini adalah ringkasan data mengenai fasilitas kesehatan yang sedang anda kelola
        </p>
        <!-- other resume -->
        <section>
            <section class="text-center columns-2 md:columns-5">
                <template v-for="item in props.resume" :key="item.name">
                    <section class="bg-green-100 p-4 rounded-xl min-w-16 break-inside-avoid mb-6 md:mb-0">
                        <h1 class="text-6xl font-semibold text-gray-800">{{ item.count }}</h1>
                        <small>{{ item.name }}</small>
                    </section>
                </template>
            </section>
        </section>
    </section>
</template>

<script setup>

const props = defineProps({
    resume: Array
})

</script>