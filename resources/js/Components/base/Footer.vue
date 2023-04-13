<template>
    <footer class="md:p-12 bg-gray-50">
        <section class="flex justify-between border-t border-gray-200 pt-6">
            <p>&copy; 2023 CekFaskesmu. All rights reserved</p>
            <section class="flex gap-3">
                <Link href="/"><i class="fa-brands fa-twitter"></i></Link>
                <Link href="/"><i class="fa-brands fa-instagram"></i></Link>
                <Link href="/"><i class="fa-brands fa-facebook"></i></Link>
                <Link href="/"><i class="fa-brands fa-linkedin"></i></Link>
            </section>
        </section>
    </footer>
</template>

<script setup>

import { Link } from '@inertiajs/vue3'

</script>