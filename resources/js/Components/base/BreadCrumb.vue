<template>
    <nav class="mb-10 flex justify-between">
        <!-- back -->
        <button @click="back" class="text-gray-300"><i class="fa-solid fa-arrow-left mr-2"></i>Kembali</button>
        <!-- home -->
        <Link href="/" class="text-gray-300"><i class="fa-solid fa-home mr-2"></i>Beranda</Link>
    </nav>
</template>

<script setup>

import { Link } from '@inertiajs/vue3'

const back = () => window.history.back()

</script>