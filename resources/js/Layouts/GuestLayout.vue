<script setup>
// import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Logo from '@/Components/base/Logo.vue'
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 px-6 md:px-0">
        <div>
            <Link href="/">
            <Logo />
            </Link>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>
